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
    $newarrival_id = $_POST["NewArrivalID"];

    $ch = curl_init("http://localhost:3000/auth/newarrival/" . $newarrival_id);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    curl_close($ch);

    header("Location: ../../pages/new-arrival.php");
    exit();
}
?>