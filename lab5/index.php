<?php
declare(strict_types=1);

require_once 'models/Transaction.php';
require_once 'repository/TransactionRepository.php';
require_once 'services/TransactionManager.php';
require_once 'views/TransactionTableRenderer.php';

$repository = new TransactionRepository();

$transactions = [
    new Transaction(1,"2025-01-10",120.5,"Online order","Amazon"),
    new Transaction(2,"2025-02-05",15.99,"Subscription","Netflix"),
    new Transaction(3,"2025-02-20",899,"Phone purchase","Apple"),
    new Transaction(4,"2025-03-01",60,"Fuel payment","Shell"),
    new Transaction(5,"2025-03-04",12.5,"Lunch","McDonalds"),
];

foreach ($transactions as $t) {
    $repository->addTransaction($t);
}

$manager = new TransactionManager($repository);
$renderer = new TransactionTableRenderer();

echo "<h2>Список транзакций</h2>";
echo $renderer->render($manager->sortTransactionsByDate());

echo "<h3>Общая сумма: ".$manager->calculateTotalAmount()."</h3>";