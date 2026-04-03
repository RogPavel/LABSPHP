
<?php
require_once 'ValidatorInterface.php';

/**
 * Валидатор корректности даты
 */
class DateValidator implements ValidatorInterface
{
    private string $error = "";

    public function validate($value): bool
    {
        if(!strtotime($value)){
            $this->error = "Некорректный формат даты";
            return false;
        }
        return true;
    }

    public function getError(): string
    {
        return $this->error;
    }
}
