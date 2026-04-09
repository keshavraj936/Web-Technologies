<?php
session_start();
require 'includes/db_connect.php';

$errors = [];
$defaultUser = isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $theme = isset($_POST['theme']) ? trim($_POST['theme']) : 'neutral';

    $stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            setcookie('remember_user', $username, time() + (86400 * 30), '/');
            setcookie('theme', $theme, time() + (86400 * 30), '/');
            header('Location: index.php');
            exit();
        }
        $errors[] = 'Invalid password.';
    } else {
        $errors[] = 'User not found.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="css/ecommerce-style.css">
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <?php foreach ($errors as $error): ?>
      <p class="alert-error"><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>
    <form method="POST">
      <label>Username</label>
      <input type="text" name="username" value="<?php echo htmlspecialchars($defaultUser); ?>" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <label>Theme Preference</label>
      <select name="theme">
        <option value="neutral">Neutral</option>
        <option value="light">Light</option>
      </select>
      <button type="submit">Login</button>
    </form>
  </div>
</body>
</html>
