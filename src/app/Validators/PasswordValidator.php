<?php
    namespace src\app\Validators;

class PasswordValidator implements ValidatorInterface
{
    private string $errorMessage = 'Password must be at least 8 characters long';

    public function validate($value, $data = []): bool
    {
        return !empty($value) && mb_strlen($value) >= 8;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
