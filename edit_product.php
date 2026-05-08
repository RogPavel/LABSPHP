<?php
/**
 * Контроллер для редактирования существующего товара.
 */
require_once 'db.php';
require_once 'bootstrap.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = (int)$_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

// Проверка прав (только админ или владелец)
if (!$product || ($_SESSION['role'] !== 'admin' && $product['user_id'] != $_SESSION['user_id'])) {
    die("У вас нет прав на редактирование этого товара.");
}

$message = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $price = $_POST['price'];
    $desc  = $_POST['description'];

    $sql = "UPDATE products SET title = ?, price = ?, description = ? WHERE id = ?";
    $pdo->prepare($sql)->execute([$title, $price, $desc, $id]);
    $message = "Товар успешно обновлен!";
    
    // Обновляем данные для отображения в форме
    $product['title'] = $title;
    $product['price'] = $price;
    $product['description'] = $desc;
}

echo $twig->render('edit_product.twig', [
    'product' => $product,
    'message' => $message,
    'session' => $_SESSION
]);