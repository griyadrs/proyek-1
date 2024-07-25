<?php
session_start(); // Memulai sesi untuk menyimpan keranjang

$mysqli = new mysqli("localhost", "root", "", "online_store");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$product_id = $_GET['id'];
$quantity = 1; 

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Periksa apakah produk sudah ada di keranjang
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] += 1; // Update kuantitas
} else {
    $_SESSION['cart'][$product_id] = 1; // Tambahkan produk baru ke keranjang
}

// Update keranjang di database (opsional, jika Anda ingin menyinkronkan dengan database)
$sql = "SELECT * FROM cart WHERE product_id = ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Jika produk sudah ada di keranjang, update kuantitas
    $sql = "UPDATE cart SET quantity = quantity + 1 WHERE product_id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $product_id);
} else {
    // Jika produk tidak ada di keranjang, tambahkan baru
    $sql = "INSERT INTO cart (product_id, quantity) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ii", $product_id, $quantity);
}

$stmt->execute();
$stmt->close();
$mysqli->close();

header("Location: index.php?status=inserted");
?>
