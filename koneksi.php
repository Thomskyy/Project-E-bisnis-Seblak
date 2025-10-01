<?php
$host = "localhost";  // biasanya: localhost
$user = "root";       // username database
$pass = "";           // password database
$db   = "ecommerce_dbseblaktest"; // nama database kamu

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>