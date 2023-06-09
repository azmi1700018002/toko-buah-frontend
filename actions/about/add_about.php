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
    $Judul = $_POST["Judul"];
    $Deskripsi = $_POST["Deskripsi"];

    $post_data = [
        "Judul" => $Judul,
        "Deskripsi" => $Deskripsi,
    ];

    $ch = curl_init("http://localhost:3000/auth/about");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    curl_close($ch);

    header("Location: ../../pages/about.php");
    exit();
}

?>