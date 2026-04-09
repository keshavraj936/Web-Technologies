<?php
session_start();
require 'includes/db_connect.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $imageUrl = trim($_POST['image_url']);

    if ($name !== '' && $price !== '') {
        $stmt = $conn->prepare('INSERT INTO products (name, price, description, image_url) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('sdss', $name, $price, $description, $imageUrl);
        if ($stmt->execute()) {
            $success = 'Product added successfully.';
        } else {
            $error = 'Database insert failed.';
        }
    } else {
        $error = 'Name and price are required.';
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
    <?php if ($success !== ''): ?><p class="alert-success"><?php echo htmlspecialchars($success); ?></p><?php endif; ?>
    <?php if ($error !== ''): ?><p class="alert-error"><?php echo htmlspecialchars($error); ?></p><?php endif; ?>
    <form method="POST">
      <label>Product Name</label>
      <input type="text" name="name" required>
      <label>Price</label>
      <input type="number" name="price" step="0.01" required>
      <label>Description</label>
      <textarea name="description" rows="3"></textarea>
      <label>Image URL</label>
      <input type="text" name="image_url">
      <button type="submit">Add Product</button>
    </form>
  </div>
</body>
</html>
