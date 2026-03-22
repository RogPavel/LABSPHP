<?php
declare(strict_types=1);

require_once __DIR__ . '/../interfaces/TransactionStorageInterface.php';

class TransactionManager
{
    public function __construct(
        private TransactionStorageInterface $repository
    ) {}

    public function calculateTotalAmount(): float
    {
        $sum = 0;
        foreach ($this->repository->getAllTransactions() as $t) {
            $sum += $t->getAmount();
        }
        return $sum;
    }

    public function calculateTotalAmountByDateRange(string $startDate, string $endDate): float
    {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        $sum = 0;

        foreach ($this->repository->getAllTransactions() as $t) {
            if ($t->getDate() >= $start && $t->getDate() <= $end) {
                $sum += $t->getAmount();
            }
        }

        return $sum;
    }

    public function countTransactionsByMerchant(string $merchant): int
    {
        $count = 0;

        foreach ($this->repository->getAllTransactions() as $t) {
            if ($t->getMerchant() === $merchant) {
                $count++;
            }
        }

        return $count;
    }

    public function sortTransactionsByDate(): array
    {
        $transactions = $this->repository->getAllTransactions();

        usort($transactions, fn($a, $b) => $a->getDate() <=> $b->getDate());

        return $transactions;
    }

    public function sortTransactionsByAmountDesc(): array
    {
        $transactions = $this->repository->getAllTransactions();

        usort($transactions, fn($a, $b) => $b->getAmount() <=> $a->getAmount());

        return $transactions;
    }
}