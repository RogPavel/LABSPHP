<?php
/**
 * Инициализация шаблонизатора Twig
 */
require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, // Отключено для разработки
    'debug' => true
]);