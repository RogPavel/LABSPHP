<?php
/**
 * Контроллер главной страницы.
 * Управляет отображением товаров и их удалением.
 */
require_once 'db.php';
require_once 'bootstrap.php';
session_start();


/**
 * Логика удаления товара
 * Выполняется только если передан ID товара и пользователь авторизован
 */
if (isset($_GET['delete_id']) && isset($_SESSION['user_id'])) {
    $deleteId = (int)$_GET['delete_id'];
    
    // Сначала проверяем владельца товара или роль админа
    $checkStmt = $pdo->prepare("SELECT user_id FROM products WHERE id = ?");
    $checkStmt->execute([$deleteId]);
    $product = $checkStmt->fetch();

    if ($product) {
        if ($_SESSION['role'] === 'admin' || $product['user_id'] == $_SESSION['user_id']) {
            $deleteStmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
            $deleteStmt->execute([$deleteId]);
            // Перенаправляем, чтобы избежать повторной отправки запроса при перезагрузке
            header("Location: index.php?msg=success_delete");
            exit;
        }
    }
}

// Получение списка товаров с учетом поиска
$search = $_GET['search'] ?? '';
try {
    $sql = "SELECT * FROM products WHERE title ILIKE ? OR category ILIKE ? ORDER BY id DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["%$search%", "%$search%"]);
    $products = $stmt->fetchAll();
} catch (PDOException $e) {
    $products = [];
}

// Рендеринг страницы через Twig
echo $twig->render('index.twig', [
    'products' => $products,
    'search'   => $search,
    'session'  => $_SESSION,
    'msg'      => $_GET['msg'] ?? null
]);