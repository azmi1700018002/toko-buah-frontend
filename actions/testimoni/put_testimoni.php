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
    $testimoni_id = $_POST["TestimoniID"]; // IdTestimoni yang akan diupdate
    $Nama = $_POST["Nama"];
    $Deskripsi = $_POST["Deskripsi"];
    $Gambar = $_FILES["gambar"];

    $post_data = [
        "TestimoniID" => $testimoni_id, // Tambahkan IdTestimoni ke data yang akan dikirim
        "Nama" => $Nama,
        "Deskripsi" => $Deskripsi,
    ];

       // Check if a new file is uploaded
       if ($Gambar["size"] > 0) {
        // Append file data to the post data
        $post_data["gambar"] = new CURLFile($Gambar["tmp_name"], $Gambar["type"], $Gambar["name"]);
    }

    $ch = curl_init($baseUrl . "auth/testimoni/" . $testimoni_id); // Gunakan URL dengan IdTestimoni yang akan diupdate
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // Menggunakan metode PUT untuk update data
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    curl_close($ch);

    if ($http_code === 200) {
        $_SESSION["message_testimoni_success"] = "Testimoni berhasil diedit";
    } else {
        $_SESSION["message_testimoni_failed"] = "Gagal edit testimoni";
    }

    // Redirect to product.php using header
    header("Location: ../../pages/testimoni.php");
    exit();
}
?>