<?php
namespace src\app\Services;

use src\app\Validators\ValidatorInterface;
use src\app\Resource\Database\UserRepository;

class UserService
{
    private array $validators;
    private string $errorMessage = '';

    public function __construct(
        private readonly UserRepository $userRepository,
        array                           $validators
    ) {
        $this->validators = $validators;
    }

    /**
     * @throws \Exception
     */
    public function validate(array $data): bool
    {
        foreach ($data as $key => $value) {
            if (isset($this->validators[$key])) {
                foreach ($this->validators[$key] as $validator) {
                    if (!$validator->validate($value, $data)) {
                        $this->errorMessage = $validator->getErrorMessage();
                        return false;
                    }
                }
            }
        }

        if ($this->userRepository->emailExists($data['email'])) {
            $this->errorMessage = 'Email already in use';
            return false;
        }

        return true;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }

    /**
     * @throws \Exception
     */
    public function registerUser(string $email, string $password): int
    {
        return $this->userRepository->createUser($email, $password);
    }
}
