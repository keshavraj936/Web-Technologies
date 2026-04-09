<?php
session_start();
require 'includes/db_connect.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header('Location: cart.php');
    exit();
}

$items = [];
if (!empty($_SESSION['cart'])) {
    $ids = array_map('intval', $_SESSION['cart']);
    $idList = implode(',', $ids);
    $query = "SELECT id, name, price FROM products WHERE id IN ($idList)";
    $res = $conn->query($query);
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $items[] = $row;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Cart</title>
  <link rel="stylesheet" href="css/ecommerce-style.css">
</head>
<body>
  <div class="form-container">
    <h2>Shopping Cart</h2>
    <p><strong>Items stored in session:</strong> <?php echo count($_SESSION['cart']); ?></p>
    <?php if (empty($items)): ?>
      <p class="alert-error">Your cart is empty.</p>
    <?php else: ?>
      <ul>
        <?php foreach ($items as $item): ?>
          <li><?php echo htmlspecialchars($item['name']); ?> - ₹<?php echo number_format((float) $item['price'], 2); ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <form method="POST">
      <button type="submit" name="clear_cart">Clear Cart</button>
    </form>
    <p><a href="view_products.php">Back to Products</a> | <a href="index.php">Home</a></p>
  </div>
</body>
</html>
