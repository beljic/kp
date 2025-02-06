<?php
namespace src\App\Validators;

use src\Resource\Database\UserRepository;

class EmailValidator implements ValidatorInterface
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function validate(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false
            && !$this->userRepository->emailExists($email);
    }

    public function getErrorMessage(): string
    {
        return 'Email is not valid or already in use';
    }
}
