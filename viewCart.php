<?php
session_start(); // Memulai sesi untuk membaca keranjang

$mysqli = new mysqli("localhost", "root", "", "online_store");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Query untuk menampilkan keranjang
$sql = "SELECT cart.id AS cart_id, products.name, products.price, cart.quantity FROM cart JOIN products ON cart.product_id = products.id";
$result = $mysqli->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cart</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <h1>Cart</h1>
        <?php 
        $total = 0;
        while ($row = $result->fetch_assoc()): 
            $subtotal = $row["price"] * $row["quantity"];
            $total += $subtotal;
        ?>
            <div class="product">
                <p><?php echo $row["name"]; ?> - $<?php echo $row["price"]; ?> x <?php echo $row["quantity"]; ?> = $<?php echo $subtotal; ?></p>
                <a class="button" href="removeFromCart.php?id=<?php echo $row["cart_id"]; ?>">Remove</a>
            </div>
        <?php endwhile; ?>
        <h2>Total: $<?php echo $total; ?></h2>
        <a class="button" href="checkout.php">Checkout</a>
        <a class="button" href="index.php">Continue Shopping</a>
    </div>
</body>
</html>

<?php
$mysqli->close();
?>
