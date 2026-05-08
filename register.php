<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];

    if (!empty($user) && !empty($email) && !empty($pass)) {
        $hash = password_hash($pass, PASSWORD_BCRYPT);
        try {
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
            $stmt->execute([$user, $email, $hash]);
            $success = "Аккаунт создан! <a href='login.php'>Войти</a>";
        } catch (PDOException $e) {
            $error = "Ошибка: Логин или Email уже заняты.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Регистрация - Bloodlily</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>Регистрация</h2>
            <?php if(isset($success)) echo "<p style='color:green'>$success</p>"; ?>
            <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
            <input type="text" name="username" placeholder="Логин" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <button type="submit">Создать аккаунт</button>
            <p><a href="login.php">Уже есть аккаунт? Войти</a></p>
        </form>
    </div>
</body>
</html>