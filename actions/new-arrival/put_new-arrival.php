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

$headers = ["Authorization: " . $token, "Content-Type: multipart/form-data"];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $new_arrival_id_id = $_POST["NewArrivalID"];
    $Nama = $_POST["Nama"];
    $Deskripsi = $_POST["Deskripsi"];
    $HargaAwal = $_POST["HargaAwal"];
    $HargaPromo = $_POST["HargaPromo"];
    $Gambar = $_FILES["gambar"];

    $post_data = [
        "NewArrivalID" => $new_arrival_id_id,
        "Nama" => $Nama,
        "Deskripsi" => $Deskripsi,
        "HargaAwal" => $HargaAwal,
        "HargaPromo" => $HargaPromo,
    ];

     // Check if a new file is uploaded
     if ($Gambar["size"] > 0) {
        // Append file data to the post data
        $post_data["gambar"] = new CURLFile($Gambar["tmp_name"], $Gambar["type"], $Gambar["name"]);
    }
    
    $ch = curl_init($baseUrl . "auth/newarrival/" . $new_arrival_id_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_newarrival_success"] = "Produk berhasil diedit";
    } else {
        $_SESSION["message_newarrival_failed"] = "Gagal edit produk";
    }
    
    header("Location: ../../pages/new-arrival.php");
    exit();
}

?>