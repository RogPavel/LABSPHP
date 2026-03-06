<?php
declare(strict_types=1);

/**
 * Массив банковских транзакций
 * 
 * @var array<int, array<string, int|string|float>>
 */
$transactions = [
    [
        "id" => 1,
        "date" => "2025-01-01",
        "amount" => 100.00,
        "description" => "Payment for groceries",
        "merchant" => "SuperMart",
    ],
    [
        "id" => 2,
        "date" => "2026-02-15",
        "amount" => 75.50,
        "description" => "Dinner with friends",
        "merchant" => "Local Restaurant",
    ],
    [
        "id" => 3,
        "date" => "2026-10-01",
        "amount" => 250.00,
        "description" => "Electronics purchase",
        "merchant" => "TechStore",
    ],
];

/**
 * Вычисляет общую сумму транзакций
 */
function calculateTotalAmount(array $transactions): float {
    $total = 0;

    foreach ($transactions as $transaction) {
        $total += $transaction['amount'];
    }

    return $total;
}

/**
 * Поиск транзакции по описанию
 */
function findTransactionByDescription(string $descriptionPart): array {
    global $transactions;

    return array_filter($transactions, function ($transaction) use ($descriptionPart) {
        return stripos($transaction['description'], $descriptionPart) !== false;
    });
}

/**
 * Поиск транзакции по ID (foreach)
 */
function findTransactionById(int $id): ?array {
    global $transactions;

    foreach ($transactions as $transaction) {
        if ($transaction['id'] === $id) {
            return $transaction;
        }
    }

    return null;
}

/**
 * Поиск транзакции по ID (array_filter)
 */
function findTransactionByIdFilter(int $id): ?array {
    global $transactions;

    $result = array_filter($transactions, fn($t) => $t['id'] === $id);

    return $result ? array_values($result)[0] : null;
}

/**
 * Количество дней с момента транзакции
 */
function daysSinceTransaction(string $date): int {
    $transactionDate = new DateTime($date);
    $today = new DateTime();

    return $today->diff($transactionDate)->days;
}

/**
 * Добавление транзакции
 */
function addTransaction(int $id, string $date, float $amount, string $description, string $merchant): void {
    global $transactions;

    $transactions[] = [
        "id" => $id,
        "date" => $date,
        "amount" => $amount,
        "description" => $description,
        "merchant" => $merchant,
    ];
}

/**
 * Сортировка по дате
 */
usort($transactions, function ($a, $b) {
    return strtotime($a['date']) <=> strtotime($b['date']);
});

$totalAmount = calculateTotalAmount($transactions);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bank Transactions & Gallery</title>


<style>

body{
    font-family: Arial;
    background:#f4f6f9;
    margin:0;
}

header{
    background:white;
    padding:15px 40px;
    box-shadow:0 2px 8px rgba(0,0,0,0.08);
}

nav a{
    text-decoration:none;
    color:#333;
    margin-right:25px;
    font-weight:bold;
}

nav a:hover{
    color:#007bff;
}

.container{
    width:90%;
    max-width:1200px;
    margin:40px auto;
}

h2{
    margin-bottom:15px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 4px 12px rgba(0,0,0,0.05);
}

thead{
    background:#007bff;
    color:white;
}

th,td{
    padding:12px;
    text-align:center;
}

tbody tr:nth-child(even){
    background:#f9fbfd;
}

tbody tr:hover{
    background:#eef4ff;
}

.total{
    margin-top:15px;
    font-weight:bold;
    text-align:right;
}

.gallery{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(250px,1fr));
    gap:20px;
    margin-top:20px;
}

.gallery img{
    width:100%;
    height:250px;
    object-fit:cover;
    border-radius:15px;
    box-shadow:0 6px 18px rgba(0,0,0,0.1);
    transition:0.3s;
}

.gallery img:hover{
    transform:scale(1.05);
}

footer{
    text-align:center;
    padding:20px;
    margin-top:50px;
    background:white;
    color:#666;
}

</style>

</head>

<body>

<header>
<nav>
<a href="#">Transactions</a>
<a href="#">Gallery</a>
<a href="#">Contacts</a>
</nav>
</header>

<div class="container">

<h2>Bank Transactions</h2>

<table>
<thead>
<tr>
<th>ID</th>
<th>Date</th>
<th>Amount</th>
<th>Description</th>
<th>Merchant</th>
<th>Days Ago</th>
</tr>
</thead>

<tbody>

<?php foreach ($transactions as $transaction): ?>

<tr>
<td><?= $transaction['id'] ?></td>
<td><?= $transaction['date'] ?></td>
<td>$<?= number_format($transaction['amount'],2) ?></td>
<td><?= $transaction['description'] ?></td>
<td><?= $transaction['merchant'] ?></td>
<td><?= daysSinceTransaction($transaction['date']) ?></td>
</tr>

<?php endforeach; ?>

</tbody>
</table>

<div class="total">
Total Amount: $<?= number_format($totalAmount,2) ?>
</div>

<hr style="margin:50px 0">

<h2>Image Gallery</h2>

<div class="gallery">

<?php

$dir = "image/";
$files = scandir($dir);

if ($files !== false) {
    foreach ($files as $file) {

        if ($file != "." && $file != ".." && pathinfo($file, PATHINFO_EXTENSION) === "jpg") {

            echo "<img src='image/$file'>";
        }
    }
}

?>

</div>

</div>

<footer>
USM © 2026
</footer>

</body>
</html>