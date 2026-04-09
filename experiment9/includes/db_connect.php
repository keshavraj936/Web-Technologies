<?php
// db_connect.php - include this in all product scripts
$conn = new mysqli();
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>