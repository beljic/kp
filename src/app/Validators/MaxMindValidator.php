<?php
namespace src\app\Validators;

class MaxMindValidator implements ValidatorInterface
{
    private string $errorMessage = 'Registration not allowed due to fraud detection';

    public function validate($value, $data = []): bool
    {
        // Simulate MaxMind check
        return $value !== 'fraud@example.com';
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
