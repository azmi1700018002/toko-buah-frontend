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
    $Nama = $_POST["Nama"];
    $Deskripsi = $_POST["Deskripsi"];
    $Gambar = $_FILES["gambar"];

    $post_data = [
        "Nama" => $Nama,
        "Deskripsi" => $Deskripsi,
    ];

    // Append file data to the post data
    $post_data["gambar"] = new CURLFile($Gambar["tmp_name"], $Gambar["type"], $Gambar["name"]);

    $ch = curl_init($baseUrl . "auth/testimoni");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_testimoni_success"] = "Testimoni berhasil ditambahkan";
    } else {
        $_SESSION["message_testimoni_failed"] = "Gagal menambahkan testimoni";
    }

    // Redirect to product.php using header
    header("Location: ../../pages/testimoni.php");
    exit();
}
?>