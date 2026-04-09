<?php
require 'includes/db_connect.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $image_url = trim($_POST['image_url']);
    if ($name && $price) {
        $stmt = $conn->prepare('INSERT INTO products (name, price, description, image_url) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('sdss', $name, $price, $description, $image_url);
        if ($stmt->execute()) {
            $success = true;
        } else {
            $error = $conn->error;
        }
    } else {
        $error = 'Name and Price are required.';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" href="css/ecommerce-style.css">
</head>
<body>
    <div class="form-container">
        <h2>Add Product</h2>
        <?php if (!empty($success)) { echo "<p class='alert-success'>Product added successfully!</p><div class='card-actions'><a href='add_product_form.php'>Add Another</a><a href='view_products.php'>View Products</a></div>"; } ?>
        <?php if (!empty($error)) { echo "<p class='alert-error'>" . htmlspecialchars($error) . "</p>"; } ?>
        <form method="POST">
            <label>Product Name</label><input type="text" name="name" required>
            <label>Price</label><input type="number" name="price" step="0.01" required>
            <label>Description</label><textarea name="description" rows="3"></textarea>
            <label>Image URL</label><input type="text" name="image_url">
            <button type="submit">Add Product</button>
        </form>
        <p><a class="muted-link" href="index.php">Back to Home</a></p>
    </div>
</body>
</html>
