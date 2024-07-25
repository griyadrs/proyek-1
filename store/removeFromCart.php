<?php
$mysqli = new mysqli("localhost", "root", "", "online_store");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$cart_id = $_GET['id'];

$sql = "DELETE FROM cart WHERE id = $cart_id";
$mysqli->query($sql);
$mysqli->close();

header("Location: viewCart.php");
?>