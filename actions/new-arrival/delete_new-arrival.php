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
    $newarrival_id = $_POST["NewArrivalID"];

    $ch = curl_init($baseUrl . "auth/newarrival/" . $newarrival_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_newarrival_success"] = "Newarrival berhasil dihapus";
    } else {
        $_SESSION["message_newarrival_failed"] = "Gagal menghapus newarrival";
    }

    header("Location: ../../pages/new-arrival.php");
    exit();
}
?>