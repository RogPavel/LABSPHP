<?php
require_once 'db.php';
require_once 'bootstrap.php';
session_start();

$error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT u.*, r.name as role_name FROM users u JOIN roles r ON u.role_id = r.id WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role_name'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}

echo $twig->render('login.twig', ['error' => $error, 'session' => $_SESSION]);