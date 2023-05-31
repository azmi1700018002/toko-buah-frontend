<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["token"])) {
    header("Location: login.php");
    exit();
}

// Extract username and token from session
$username = $_SESSION["Username"];
$token = "Bearer " . $_SESSION["token"];

$headers = ["Authorization: " . $token];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $produk_id = $_POST["ProdukID"]; // IdProduk yang akan diupdate
    $Nama = $_POST["Nama"];
    $Deskripsi = $_POST["Deskripsi"];
    $Harga = $_POST["Harga"];
    $Stok = $_POST["Stok"];
    $Gambar = $_FILES["gambar"];

    $post_data = [
        "ProdukID" => $produk_id, // Tambahkan IdProduk ke data yang akan dikirim
        "Nama" => $Nama,
        "Deskripsi" => $Deskripsi,
        "Harga" => $Harga,
        "Stok" => $Stok,
    ];

       // Check if a new file is uploaded
       if ($Gambar["size"] > 0) {
        // Append file data to the post data
        $post_data["gambar"] = new CURLFile($Gambar["tmp_name"], $Gambar["type"], $Gambar["name"]);
    }

    $ch = curl_init("http://localhost:3000/auth/produk/" . $produk_id); // Gunakan URL dengan IdProduk yang akan diupdate
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Menggunakan metode PUT untuk update data
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_produk_success"] = "Produk berhasil diedit";
    } else {
        $_SESSION["message_produk_failed"] = "Gagal edit produk";
    }

    // Redirect to product.php using header
    header("Location: ../../pages/product.php");
    exit();
}
?>