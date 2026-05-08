<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $desc  = trim($_POST['description']);
    $cat   = $_POST['category'];
    $price = $_POST['price'];
    $avail = isset($_POST['available']) ? 1 : 0;
    $user_id = $_SESSION['user_id'];

    if (!empty($title) && $price > 0) {
        $sql = "INSERT INTO products (title, description, category, price, is_available, user_id) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$title, $desc, $cat, $price, $avail, $user_id]);
        $success = "Товар успешно добавлен!";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить товар - Bloodlily</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav><div class="logo">BLOODLILY</div><a href="index.php">Назад</a></nav>
    <div class="container">
        <form method="POST">
            <h2>Новый товар</h2>
            <?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>
            <input type="text" name="title" placeholder="Название" required>
            <textarea name="description" placeholder="Описание"></textarea>
            <select name="category">
                <option value="Luxury">Luxury</option>
                <option value="Premium">Premium</option>
            </select>
            <input type="number" name="price" step="0.01" placeholder="Цена (MDL)">
            <label><input type="checkbox" name="available" checked> В наличии</label>
            <button type="submit">Сохранить</button>
        </form>
    </div>
</body>
</html>