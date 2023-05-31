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

$headers = ["Authorization: " . $token, "Content-Type: multipart/form-data"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Nama = $_POST["Nama"];
    $Deskripsi = $_POST["Deskripsi"];
    $HargaAwal = $_POST["HargaAwal"];
    $HargaPromo = $_POST["HargaPromo"];
    $Gambar = $_FILES["gambar"];

    $post_data = [
        "Nama" => $Nama,
        "Deskripsi" => $Deskripsi,
        "HargaAwal" => $HargaAwal,
        "HargaPromo" => $HargaPromo,
    ];

     // Append file data to the post data
     $post_data["gambar"] = new CURLFile($Gambar["tmp_name"], $Gambar["type"], $Gambar["name"]);
     
    $ch = curl_init("http://localhost:3000/auth/newarrival");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_newarrival_success"] = "Newarrival berhasil ditambahkan";
    } else {
        $_SESSION["message_newarrival_failed"] = "Gagal menambahkan newarrival";
    }

    header("Location: ../../pages/new-arrival.php");
    exit();
}

?>