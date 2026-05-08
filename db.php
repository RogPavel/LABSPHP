<?php
/**
 * Файл для подключения к PostgreSQL через PDO
 */
$host = "localhost";
$port = "5432";
$db   = "bloodlilly.db";
$user = "postgres";
$pass = "1111";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$db;";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}
?>