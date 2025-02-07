<?php
namespace src\app\Validators;

class PasswordValidator implements ValidatorInterface {
    public function validate(mixed $password): bool {
        return strlen($password) >= 8;
    }

    public function getErrorMessage(): string {
        return 'Password must be at least 8 characters long';
    }
}