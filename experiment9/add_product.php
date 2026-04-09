<?php
require 'db_connect.php';
$name = trim($_POST['name']);
$price = trim($_POST['price']);
$description = trim($_POST['description']);
$image_url = trim($_POST['image_url']);
if ($name && $price) {
    $stmt = $conn->prepare('INSERT INTO products (name, price, description, image_url) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('sdss', $name, $price, $description, $image_url);
    if ($stmt->execute()) {
        echo '<h3>Product added successfully!</h3>';
    } else {
        echo '<h3 style="color:red;">Error: ' . $conn->error . '</h3>';
    }
    echo '<a href="add_product_form.html">Add Another</a> | <a href="view_products.php">View Products</a>';
} else {
    echo '<h3 style="color:red;">Name and Price are required.</h3>';
    echo '<a href="add_product_form.html">Go Back</a>';
}
?>