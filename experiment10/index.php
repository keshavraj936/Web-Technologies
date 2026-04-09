<?php
session_start();

$lastVisit = isset($_COOKIE['last_visit']) ? $_COOKIE['last_visit'] : 'First visit';
$rememberedUser = isset($_COOKIE['remember_user']) ? $_COOKIE['remember_user'] : 'Not set';
$preferredTheme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'neutral';
$cartCount = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;

setcookie('last_visit', date('Y-m-d H:i:s'), time() + (86400 * 30), '/');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TechShop - Experiment 10</title>
  <link rel="stylesheet" href="css/ecommerce-style.css">
</head>
<body>
  <header>
    <h1 class="site-title">TechShop Electronics</h1>
    <p class="tagline">Experiment 10 - Sessions and Cookies</p>
  </header>

  <nav class="nav">
    <a href="index.php">Home</a>
    <a href="view_products.php">Products</a>
    <a href="add_product_form.php">Add Product</a>
    <a href="cart.php">Cart</a>
    <?php if (!isset($_SESSION['user_id'])): ?>
      <a href="register.php">Register</a>
      <a href="login.php">Login</a>
    <?php else: ?>
      <span>Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
      <a href="logout.php">Logout</a>
    <?php endif; ?>
  </nav>

  <main>
    <section class="banner">
      <h2>Welcome to Exercise-2 Store</h2>
      <p>Session and cookie data is shared across multiple pages.</p>
    </section>

    <section class="card">
      <h3>Session + Cookie Demo</h3>
      <p><strong>Logged in user (Session):</strong> <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Not logged in'; ?></p>
      <p><strong>Cart items (Session):</strong> <?php echo $cartCount; ?></p>
      <p><strong>Remembered user (Cookie):</strong> <?php echo htmlspecialchars($rememberedUser); ?></p>
      <p><strong>Preferred theme (Cookie):</strong> <?php echo htmlspecialchars($preferredTheme); ?></p>
      <p><strong>Last visit (Cookie):</strong> <?php echo htmlspecialchars($lastVisit); ?></p>
    </section>
  </main>

  <footer>
    <p>&copy; 2026 TechShop Electronics</p>
  </footer>
</body>
</html>
