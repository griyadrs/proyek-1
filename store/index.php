<?php
$mysqli = new mysqli("localhost", "root", "", "online_store");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query untuk menampilkan produk
$sql = "SELECT * FROM products";
$result = $mysqli->query($sql);

// Query untuk menghitung jumlah item di keranjang
$sqlCartCount = "SELECT COUNT(*) as count FROM cart";
$resultCartCount = $mysqli->query($sqlCartCount);
$cartCount = $resultCartCount->fetch_assoc()["count"];

$status = isset($_GET['status']) ? $_GET['status'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Products</h1>
        <?php if ($status == 'inserted'): ?>
            <p class="message success">Product added to cart!</p>
        <?php elseif ($status == 'updated'): ?>
            <p class="message success">Product quantity updated in cart!</p>
        <?php endif; ?>

        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="product">
                <p><?php echo $row["name"]; ?> - $<?php echo $row["price"]; ?></p>
                <a class="button" href="addToCart.php?id=<?php echo $row["id"]; ?>">Add to Cart</a>
            </div>
        <?php endwhile; ?>

        <?php if ($cartCount > 0): ?>
            <a class="button" href="viewCart.php">View Cart (<?php echo $cartCount; ?> items)</a>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>
