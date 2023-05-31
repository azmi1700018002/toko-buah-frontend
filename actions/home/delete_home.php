<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["token"])) {
    header("Location: login.php");
}

// Extract token from session
$token = "Bearer " . $_SESSION["token"];

$headers = ["Authorization: " . $token, "Content-Type: application/json"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $home_id = $_POST["HomeID"];

    $ch = curl_init("http://localhost:3000/auth/home/" . $home_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
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