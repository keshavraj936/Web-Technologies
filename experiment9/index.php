<?php
// index.php - Home page for independent experiment9
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechShop - Home</title>
    <link rel="stylesheet" href="css/ecommerce-style.css">
</head>
<body>
    <header>
        <h1 class="site-title">TechShop Electronics</h1>
        <p class="tagline">Your One-Stop Electronics Store</p>
    </header>
    <nav class="nav">
        <a href="index.php">Home</a>
        <a href="view_products.php">Products</a>
        <a href="add_product_form.php">Add Product</a>
        <?php if (!isset($_SESSION['user_id'])): ?>
        <a href="register.php">Register</a>
        <a href="login.php">Login</a>
        <?php else: ?>
        <a href="logout.php">Logout</a>
        <span style="color:#6b7280; margin-left:16px;">Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
        <?php endif; ?>
    </nav>
    <main>
        <div class="banner">
            <h2 style="font-size: 2.5rem; margin-bottom: 20px;">Welcome to TechShop</h2>
            <p style="font-size: 1.2rem; margin-bottom: 20px;">
                Discover the latest electronics and gadgets at amazing prices!
            </p>
            <p style="font-size: 1.1rem;">
                We offer <mark style="background-color: #e5e7eb; padding: 5px 10px; border-radius: 5px; color: #111827;">FREE SHIPPING</mark> on orders over $50.
            </p>
        </div>
        <section class="table-container">
            <h3 style="margin-top:0;">Quick Actions</h3>
            <p style="color:#6b7280;">Manage your catalog, account, and products from a single dashboard.</p>
            <div class="card-actions">
                <a href="view_products.php">Browse Products</a>
                <a href="add_product_form.php">Add New Product</a>
                <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="register.php">Create Account</a>
                <?php endif; ?>
            </div>
        </section>
    </main>
    <footer>
        <p style="font-size: 1.1rem; margin-bottom: 15px;">&copy; 2026 TechShop Electronics. All rights reserved.</p>
        <address style="font-style: normal; line-height: 1.8;">Contact us: <a href="mailto:info@techshop.com">info@techshop.com</a><br></address>
    </footer>
</body>
</html>
