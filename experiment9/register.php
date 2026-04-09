<?php
// register.php - User registration form
require 'includes/db_connect.php';
$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $gender = trim($_POST['gender']);
    $phone = trim($_POST['phone']);
    $password = trim($_POST['password']);
    if (empty($username)) $errors[] = 'Username is required.';
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required.';
    if (empty($gender)) $errors[] = 'Gender is required.';
    if (!preg_match('/^[0-9]{10}$/', $phone)) $errors[] = 'Valid 10-digit phone number is required.';
    if (strlen($password) < 6) $errors[] = 'Password must be at least 6 characters.';
    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $conn->query("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(100), email VARCHAR(100), gender VARCHAR(10), phone VARCHAR(15), password VARCHAR(255))");
        $stmt = $conn->prepare('INSERT INTO users (username, email, gender, phone, password) VALUES (?, ?, ?, ?, ?)');
        $stmt->bind_param('sssss', $username, $email, $gender, $phone, $password_hash);
        if ($stmt->execute()) {
            $success = true;
        } else {
            $errors[] = 'Registration failed.';
        }
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
        <?php if (!empty($errors)) { foreach ($errors as $e) echo "<p class='alert-error'>" . htmlspecialchars($e) . "</p>"; } ?>
        <?php if (!empty($success)) { echo "<p class='alert-success'>Registration successful!</p><a class='muted-link' href='login.php'>Login Now</a>"; } else { ?>
        <form method="POST">
            <label>Username</label><input type="text" name="username" required>
            <label>Email</label><input type="email" name="email" required>
            <label>Gender</label><select name="gender" required><option value="">Select</option><option>Male</option><option>Female</option><option>Other</option></select>
            <label>Phone</label><input type="text" name="phone" required>
            <label>Password</label><input type="password" name="password" required>
            <button type="submit">Register</button>
        </form>
        <?php } ?>
        <p><a class="muted-link" href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
