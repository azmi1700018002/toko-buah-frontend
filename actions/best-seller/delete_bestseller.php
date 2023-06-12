<?php
require_once("../../config/server.php");

session_start();

// Check if user is logged in
if (!isset($_SESSION["token"])) {
    header("Location: login.php");
}

// Extract token from session
$token = "Bearer " . $_SESSION["token"];

$headers = ["Authorization: " . $token, "Content-Type: application/json"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $bestseller_id = $_POST["BestsellerID"];

    $ch = curl_init($baseUrl . "auth/bestseller/" . $bestseller_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    
    if ($http_code === 200) {
        $_SESSION["message_bestseller_success"] = "Bestseller berhasil dihapus";
    } else {
        $_SESSION["message_bestseller_failed"] = "Gagal hapus bestseller";
    }

    header("Location: ../../pages/best-seller.php");
    exit();
}
?>