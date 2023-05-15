<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["token"])) {
    header("Location: login.php");
}

// Extract username and token from session
$id_user = $_SESSION["UserID"];
$username = $_SESSION["Username"];
$profile_picture = $_SESSION["ProfilePicture"];
$token = $_SESSION["token"];
?>