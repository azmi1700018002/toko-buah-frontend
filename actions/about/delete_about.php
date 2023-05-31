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
    $about_id = $_POST["AboutID"];

    $ch = curl_init("http://localhost:3000/auth/about/" . $about_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_about_success"] = "About berhasil dihapus";
    } else {
        $_SESSION["message_about_failed"] = "Gagal hapus about";
    }
    header("Location: ../../pages/about.php");
    exit();
}
?>