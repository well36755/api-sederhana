<?php
$host = "localhost";
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$database = "chataibackend2";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die(json_encode(["error" => "Koneksi gagal: " . mysqli_connect_error()]));
}

mysqli_set_charset($conn, "utf8mb4");
?>