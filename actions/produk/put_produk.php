<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["token"])) {
    header("Location: login.php");
}

// Extract username and token from session
$username = $_SESSION["Username"];
$token = "Bearer " . $_SESSION["token"];

$headers = ["Authorization: " . $token, "Content-Type: multipart/form-data"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produk_id = $_POST["ProdukID"];
    $Nama = $_POST["Nama"];
    $Deskripsi = $_POST["Deskripsi"];
    $Harga = $_POST["Harga"];
    $Stok = $_POST["Stok"];

    $post_data = [
        "ProdukID" => $produk_id,
        "Nama" => $Nama,
        "Deskripsi" => $Deskripsi,
        "Harga" => $Harga,
        "Stok" => $Stok,
    ];

    $ch = curl_init("http://localhost:3000/auth/produk/" . $produk_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    curl_close($ch);
    
    header("Location: ../../pages/product.php");
    exit();
}

?>