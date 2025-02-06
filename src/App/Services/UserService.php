<?php
namespace src\App\Services;

use src\Resource\Database\UserRepository;

class UserService {
    private EmailValidator $emailValidator;
    private PasswordValidator $passwordValidator;
    private string $errorMessage = '';

    private readonly UserRepository $userRepository;


    public function __construct(EmailValidator $emailValidator, PasswordValidator $passwordValidator)
    {
        $this->emailValidator = $emailValidator;
        $this->passwordValidator = $passwordValidator;
        $this->userRepository = new UserRepository();
    }

    public function validate(string $email, string $password, string $password2): bool
    {
        if (!$this->emailValidator->validate($email)) {
            $this->errorMessage = "Invalid email format";
            return false;
        }

        if (!$this->passwordValidator->validate($password)) {
            $this->errorMessage = "Password must be at least 8 characters long";
            return false;
        }

        if ($password !== $password2) {
            $this->errorMessage = "Passwords do not match";
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    public function registerUser(string $email, string $password): int
    {
        $this->userRepository->createUser($email, $password);
    }
}