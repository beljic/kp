<?php
namespace src\app\Validators;

use Exception;
use src\app\Resource\Database\UserRepository;

class EmailExistsValidator implements ValidatorInterface
{
    private string $errorMessage = 'Email already exists';
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @throws Exception
     */
    public function validate($value, $data = []): bool
    {
        return !$this->userRepository->emailExists($value);
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
