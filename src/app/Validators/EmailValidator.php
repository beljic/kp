<?php
namespace src\app\Validators;

use src\app\Resource\Database\UserRepository;

class EmailValidator implements ValidatorInterface
{

    public function validate(mixed $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getErrorMessage(): string
    {
        return 'Email is not valid or already in use';
    }
}
