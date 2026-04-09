<?php
// Simple PHP form handler for Exercise 2 Registration Form
$username = $email = $gender = $phone = $password = "";
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $gender = trim($_POST["gender"]);
    $phone = trim($_POST["phone"]);
    $password = trim($_POST["password"]);
    if (empty($username)) $errors[] = "Username is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (!preg_match('/^[0-9]{10}$/', $phone)) $errors[] = "Valid 10-digit phone number is required.";
    if (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if (empty($errors)) {
        echo "<h3>Registration successful! Welcome, $username.</h3>";
        echo "<p><b>Email:</b> $email</p>";
        echo "<p><b>Gender:</b> $gender</p>";
        echo "<p><b>Phone:</b> $phone</p>";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='exercise2_registration_form.html'>Go Back</a>";
    }
} else {
    header("Location: exercise2_registration_form.html");
    exit();
}
?>