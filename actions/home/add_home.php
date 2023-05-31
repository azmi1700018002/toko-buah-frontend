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
    $Sutitle = $_POST["Subtitle"];
    $Title = $_POST["Title"];
    $Deskripsi = $_POST["Deskripsi"];

    $post_data = [
        "Subtitle" => $Subtitle,
        "Title" => $Title,
        "Deskripsi" => $Deskripsi,
    ];

    $ch = curl_init("http://localhost:3000/auth/home");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_home_success"] = "Home berhasil ditambahkan";
    } else {
        $_SESSION["message_home_failed"] = "Gagal menambahkan home";
    }
    
    header("Location: ../../pages/home.php");
    exit();
}

?>