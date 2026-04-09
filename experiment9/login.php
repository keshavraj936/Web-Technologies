<?php
// login.php - User login form
require 'includes/db_connect.php';
session_start();
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $stmt = $conn->prepare('SELECT id, password FROM users WHERE username=?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit();
        } else {
            $errors[] = 'Invalid password.';
        }
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
        <?php if (!empty($errors)) { foreach ($errors as $e) echo "<p class='alert-error'>" . htmlspecialchars($e) . "</p>"; } ?>
        <form method="POST">
            <label>Username</label><input type="text" name="username" required>
            <label>Password</label><input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a class="muted-link" href="register.php">Register</a></p>
        <p><a class="muted-link" href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
