<?php
session_start();
require 'includes/db_connect.php';

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($username === '') $errors[] = 'Username is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';

    if (empty($errors)) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare('INSERT INTO users (username, email, gender, phone, password) VALUES (?, ?, ?, ?, ?)');
        $gender = 'NA';
        $phone = '0000000000';
        $stmt->bind_param('sssss', $username, $email, $gender, $phone, $passwordHash);
        if ($stmt->execute()) {
            setcookie('remember_user', $username, time() + (86400 * 30), '/');
            header('Location: login.php');
            exit();
        }
        $errors[] = 'Registration failed.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="css/ecommerce-style.css">
</head>
<body>
  <div class="form-container">
    <h2>Register</h2>
    <?php foreach ($errors as $error): ?>
      <p class="alert-error"><?php echo htmlspecialchars($error); ?></p>
    <?php endforeach; ?>
    <form method="POST">
      <label>Username</label>
      <input type="text" name="username" required>
      <label>Email</label>
      <input type="email" name="email" required>
      <label>Password</label>
      <input type="password" name="password" required>
      <button type="submit">Create Account</button>
    </form>
  </div>
</body>
</html>
