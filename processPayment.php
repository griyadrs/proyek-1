<?php
session_start();

// Cek jika ada data yang dikirimkan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $name = $_POST['name'];
    $address = $_POST['address'];
    $payment = $_POST['payment'];
    
    // Validasi dan proses pembayaran (ini hanya contoh sederhana)
    // Di sini Anda bisa menghubungkan ke API pembayaran atau sistem lainnya
    
    // Hapus keranjang belanja setelah pembayaran
    unset($_SESSION['cart']);
    
    // Redirect ke halaman sukses atau terima kasih
    header('Location: thankYou.php');
    exit();
} else {
    // Redirect ke halaman produk jika akses langsung
    header('Location: showProduct.php');
    exit();
}
