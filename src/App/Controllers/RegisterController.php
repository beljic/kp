<?php
namespace App\Controllers;

use App\Managers\UserManager;
use App\Validators\EmailValidator;
use App\Validators\PasswordValidator;
use App\Validators\RequiredFieldValidator;
use App\Responses\JsonResponse;
use Exception;

class RegisterController
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function register(array $requestData): void
    {
        $requiredFieldValidator = new RequiredFieldValidator();
        $errors = $requiredFieldValidator->validateMultiple($requestData);

        if ($errors) {
            JsonResponse::error(implode(", ", $errors));
        }

        $emailValidator = new EmailValidator();
        if (!$emailValidator->validate($requestData['email'])) {
            JsonResponse::error('email_invalid');
        }

        $passwordValidator = new PasswordValidator();
        if (!$passwordValidator->validate($requestData['password'])) {
            JsonResponse::error('password_invalid');
        }

        if ($requestData['password'] !== $requestData['password2']) {
            JsonResponse::error('password_mismatch');
        }

        try {
            $userId = $this->userManager->createUser($requestData['email'], $requestData['password']);
            JsonResponse::success(['userId' => $userId]);
        } catch (Exception $e) {
            JsonResponse::error($e->getMessage());
        }
    }
}
