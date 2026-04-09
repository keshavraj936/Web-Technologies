<?php
// db_connect.php - include this in all product scripts
$conn = new mysqli('sql300.infinityfree.com', 'if0_41622075', 'Krs9091936', 'if0_41622075_experiment9', 3306);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>