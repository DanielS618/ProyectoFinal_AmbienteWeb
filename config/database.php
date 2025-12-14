<?php

$host = "127.0.0.1";   // Su puerto de Apache
$port = "3307";        // Su puerto de MySQL
$db   = "delfin_blanco";
$user = "root";
$pass = "";
$charset = "utf8mb4";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$db;charset=$charset",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
