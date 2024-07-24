<?php
session_start(); // Memulai sesi untuk membaca keranjang

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: index.php');
    exit();
}

// Hitung total harga
$total = 0;
foreach ($_SESSION['cart'] as $id => $quantity) {
    // Ambil harga produk dari database
    $mysqli = new mysqli("localhost", "root", "", "online_store");
    
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    $sql = "SELECT price FROM products WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        $price = $row['price'];
        $total += $price * $quantity;
    }

    $stmt->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="checkout-container">
        <h1>Checkout</h1>
        <p class="total">Total: $<?php echo number_format($total, 2); ?></p>
        
        <form action="processPayment.php" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            
            <label for="payment">Payment Method:</label>
            <select id="payment" name="payment">
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
            </select>
            
            <input type="submit" value="Complete Purchase" class="button">
        </form>
    </div>
</body>
</html>
