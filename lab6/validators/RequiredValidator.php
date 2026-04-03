
<?php
require_once 'ValidatorInterface.php';

/**
 * Валидатор обязательного поля
 */
class RequiredValidator implements ValidatorInterface
{
    private string $error = "";

    public function validate($value): bool
    {
        if(empty($value)){
            $this->error = "Поле обязательно для заполнения";
            return false;
        }
        return true;
    }

    public function getError(): string
    {
        return $this->error;
    }
}
