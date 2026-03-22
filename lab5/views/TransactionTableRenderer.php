<?php
declare(strict_types=1);

class TransactionTableRenderer
{
    public function render(array $transactions): string
    {
        $html = "<table border='1' cellpadding='8'>";
        $html .= "<tr>
                    <th>ID</th>
                    <th>Дата</th>
                    <th>Сумма</th>
                    <th>Описание</th>
                    <th>Получатель</th>
                    <th>Категория</th>
                    <th>Дней назад</th>
                  </tr>";

        foreach ($transactions as $t) {

            $category = $this->getCategory($t->getMerchant());

            $html .= "<tr>
                        <td>{$t->getId()}</td>
                        <td>{$t->getDate()->format('Y-m-d')}</td>
                        <td>{$t->getAmount()}</td>
                        <td>{$t->getDescription()}</td>
                        <td>{$t->getMerchant()}</td>
                        <td>{$category}</td>
                        <td>{$t->getDaysSinceTransaction()}</td>
                      </tr>";
        }

        return $html . "</table>";
    }

    private function getCategory(string $merchant): string
    {
        return [
            "Amazon" => "Shopping",
            "Netflix" => "Entertainment",
            "Apple" => "Technology",
            "Shell" => "Fuel",
            "McDonalds" => "Food",
            "Steam" => "Games",
            "Uber" => "Transport",
            "Booking" => "Travel"
        ][$merchant] ?? "Other";
    }
}