<?php
// Simple PHP form handler for Exercise 1 Contact Form
$name = $email = $gender = $phone = $message = "";
$errors = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $gender = trim($_POST["gender"]);
    $phone = trim($_POST["phone"]);
    $message = trim($_POST["message"]);
    if (empty($name)) $errors[] = "Name is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Valid email is required.";
    if (empty($gender)) $errors[] = "Gender is required.";
    if (!preg_match('/^[0-9]{10}$/', $phone)) $errors[] = "Valid 10-digit phone number is required.";
    if (empty($message)) $errors[] = "Message is required.";
    if (empty($errors)) {
        echo "<h3>Thank you, $name! Your message has been received.</h3>";
        echo "<p><b>Email:</b> $email</p>";
        echo "<p><b>Gender:</b> $gender</p>";
        echo "<p><b>Phone:</b> $phone</p>";
        echo "<p><b>Message:</b> $message</p>";
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
        echo "<a href='exercise1_contact_form.html'>Go Back</a>";
    }
} else {
    header("Location: exercise1_contact_form.html");
    exit();
}
?>