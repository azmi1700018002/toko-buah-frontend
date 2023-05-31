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
    $about_id = $_POST["AboutID"];
    $Judul = $_POST["Judul"];
    $Deskripsi = $_POST["Deskripsi"];
    $post_data = [
        "AboutID" => $about_id,
        "Judul" => $Judul,
        "Deskripsi" => $Deskripsi,
    ];

    $ch = curl_init("http://localhost:3000/auth/about/" . $about_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_about_success"] = "About berhasil edit";
    } else {
        $_SESSION["message_about_failed"] = "Gagal edit about";
    }

    header("Location: ../../pages/about.php");
    exit();
}

?>