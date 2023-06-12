<?php
require_once("../../config/server.php");

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
    $bestseller_id = $_POST["BestsellerID"]; // IdBestseller yang akan diupdate
    $Nama = $_POST["Nama"];
    $Deskripsi = $_POST["Deskripsi"];
    $Gambar = $_FILES["gambar"];

    $post_data = [
        "BestsellerID" => $bestseller_id, // Tambahkan IdBestseller ke data yang akan dikirim
        "Nama" => $Nama,
        "Deskripsi" => $Deskripsi,
    ];

       // Check if a new file is uploaded
       if ($Gambar["size"] > 0) {
        // Append file data to the post data
        $post_data["gambar"] = new CURLFile($Gambar["tmp_name"], $Gambar["type"], $Gambar["name"]);
    }

    $ch = curl_init($baseUrl . "auth/bestseller/" . $bestseller_id); // Gunakan URL dengan IdBestseller yang akan diupdate
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Menggunakan metode PUT untuk update data
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_bestseller_success"] = "Bestseller berhasil diedit";
    } else {
        $_SESSION["message_bestseller_failed"] = "Gagal edit bestseller";
    }

    // Redirect to best-seller.php using header
    header("Location: ../../pages/best-seller.php");
    exit();
}
?>