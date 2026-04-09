<?php
require 'includes/db_connect.php';
$result = $conn->query('SELECT * FROM products');
echo '<!DOCTYPE html><html><head><title>Product List</title><link rel="stylesheet" href="css/ecommerce-style.css"></head><body>';
echo '<h2 style="text-align:center;">Product List</h2>';
echo '<div class="table-container">';
echo '<table><tr><th>ID</th><th>Name</th><th>Price</th><th>Description</th><th>Image</th></tr>';
while($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>' . $row['id'] . '</td>';
    echo '<td>' . htmlspecialchars($row['name']) . '</td>';
    echo '<td>₹' . number_format($row['price'],2) . '</td>';
    echo '<td>' . htmlspecialchars($row['description']) . '</td>';
    echo '<td>';
    if ($row['image_url']) {
        echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="Product Image">';
    } else {
        echo 'N/A';
    }
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '<div style="text-align:center; margin-top: 16px;"><a href="add_product_form.php">Add Product</a> | <a href="index.php">Home</a></div>';
echo '</div>';
echo '</body></html>';
?>
