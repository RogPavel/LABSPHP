
<?php
/**
 * Интерфейс валидатора.
 * Каждый валидатор должен реализовывать методы проверки данных.
 */
interface ValidatorInterface
{
    /**
     * Метод проверки значения
     * @param mixed $value Проверяемое значение
     * @return bool Результат проверки
     */
    public function validate($value): bool;

    /**
     * Получение текста ошибки
     * @return string
     */
    public function getError(): string;
}
