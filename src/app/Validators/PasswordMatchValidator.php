<?php
namespace src\app\Validators;

class PasswordMatchValidator implements ValidatorInterface
{
    private string $errorMessage = 'Passwords do not match';

    public function validate($value, $data = []): bool
    {
        return isset($data['password']) && $value === $data['password'];
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
