<?php
declare(strict_types=1);

/**
 * Система банковских транзакций и галерея изображений
 *
 * Данный скрипт демонстрирует работу с массивами, функциями,
 * поиском, сортировкой и выводом данных в PHP.
 * Также реализована простая галерея изображений,
 * которая автоматически загружает картинки из папки.
 
 


/**
 * Массив банковских транзакций.
 *
 * Каждая транзакция содержит:
 * id — уникальный номер транзакции
 * date — дата транзакции
 * amount — сумма платежа
 * description — описание операции
 * merchant — название магазина или компании
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
 * Вычисляет общую сумму всех транзакций.
 *
 * Функция проходит по массиву транзакций
 * и складывает значения поля amount.
 *
 * @param array $transactions массив транзакций
 * @return float общая сумма всех транзакций
 */
 ```php
function calculateTotalAmount(array $transactions): float {
    $total = 0;

    foreach ($transactions as $transaction) {
        $total += $transaction['amount'];
    }

    return $total;
}


/**
 * Поиск транзакций по части описания.
 *
 * Функция ищет транзакции, в которых
 * описание содержит указанный текст.
 *
 * @param string $descriptionPart часть текста описания
 * @return array найденные транзакции
 */

function findTransactionByDescription(string $descriptionPart): array {
    global $transactions;

    return array_filter($transactions, function ($transaction) use ($descriptionPart) {
        return stripos($transaction['description'], $descriptionPart) !== false;
    });
}


/**
 * Поиск транзакции по ID с помощью цикла foreach.
 *
 * @param int $id идентификатор транзакции
 * @return array|null найденная транзакция или null
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
 * Поиск транзакции по ID с использованием array_filter.
 *
 * @param int $id идентификатор транзакции
 * @return array|null найденная транзакция или null
 */
function findTransactionByIdFilter(int $id): ?array {
    global $transactions;

    $result = array_filter($transactions, fn($t) => $t['id'] === $id);

    return $result ? array_values($result)[0] : null;
}


/**
 * Определяет сколько дней прошло с момента транзакции.
 *
 * @param string $date дата транзакции (формат YYYY-MM-DD)
 * @return int количество дней
 */
function daysSinceTransaction(string $date): int {
    $transactionDate = new DateTime($date);
    $today = new DateTime();

    return $today->diff($transactionDate)->days;
}


/**
 * Добавляет новую транзакцию в список.
 *
 * @param int $id идентификатор транзакции
 * @param string $date дата транзакции
 * @param float $amount сумма операции
 * @param string $description описание операции
 * @param string $merchant название магазина
 * @return void
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
 * Сортировка транзакций по дате.
 *
 * Транзакции сортируются от самой ранней
 * к самой поздней.
 */
usort($transactions, function ($a, $b) {
    return strtotime($a['date']) <=> strtotime($b['date']);
});


/**
 * Подсчёт общей суммы всех транзакций.
 */
$totalAmount = calculateTotalAmount($transactions);


/**
 * Блок галереи изображений.
 *
 * Скрипт читает все изображения из папки image
 * и выводит их на страницу.
 */
?>

<?php

/**
 * Что такое массив в PHP
 *
 * Массив — это переменная, которая может хранить несколько значений
 * одновременно. Каждый элемент массива имеет индекс или ключ.
 */


/**
 * Создание массива в PHP
 *
 * Массив можно создать несколькими способами:
 *
 * 1. С помощью функции array()
 * $numbers = array(1, 2, 3, 4);
 *
 * 2. С помощью квадратных скобок
 * $numbers = [1, 2, 3, 4];
 *
 * 3. Добавлением элементов по индексу
 * $numbers[0] = 1;
 * $numbers[1] = 2;
 * 
 * Создание ассоциативного массива
 *
 * Ассоциативный массив использует строковые ключи вместо
 * числовых индексов.
 *
 * @return array Возвращает ассоциативный массив
 *
 * Пример:
 * $student = [
 *     "name" => "Иван",
 *     "age" => 18,
 *     "grade" => 10
 * ];
 */
 


/**
 * Цикл foreach
 *
 * Цикл foreach используется для перебора элементов массива.
 * Он проходит по каждому элементу массива и позволяет
 * работать с его значением.
 *
 * Пример:
 * foreach ($array as $value) {
 *     echo $value;
 * }
 */

?>

