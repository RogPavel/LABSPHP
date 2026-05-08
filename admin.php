<?php
require_once 'db.php';
require_once 'bootstrap.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Доступ запрещен");
}

if (isset($_GET['delete'])) {
    $pdo->prepare("DELETE FROM users WHERE id = ?")->execute([(int)$_GET['delete']]);
    header("Location: admin.php");
    exit;
}

$users = $pdo->query("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id ORDER BY u.id")->fetchAll();

echo $twig->render('admin.twig', ['users' => $users, 'session' => $_SESSION]);