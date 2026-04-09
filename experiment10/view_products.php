<?php
session_start();
require 'includes/db_connect.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $_SESSION['cart'][] = (int) $_POST['product_id'];
    header('Location: view_products.php');
    exit();
}

$result = $conn->query('SELECT * FROM products');
?>
<!DOCTYPE html>
<html>
<head>
  <title>Products</title>
  <link rel="stylesheet" href="css/ecommerce-style.css">
</head>
<body>
  <header>
    <h1 class="site-title">Products</h1>
    <p class="tagline">Cart items in session: <?php echo count($_SESSION['cart']); ?></p>
  </header>
  <main>
    <section class="table-container">
      <table>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Price</th>
          <th>Description</th>
          <th>Action</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo htmlspecialchars($row['name']); ?></td>
            <td>₹<?php echo number_format((float) $row['price'], 2); ?></td>
            <td><?php echo htmlspecialchars($row['description']); ?></td>
            <td>
              <form method="POST">
                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                <button class="btn" type="submit">Add to Cart</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
      <p><a href="cart.php">Go to Cart</a> | <a href="index.php">Home</a></p>
    </section>
  </main>
</body>
</html>
