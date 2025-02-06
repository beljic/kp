<?php
require __DIR__ . '/../vendor/autoload.php';

use src\App\Services\UserService;
use src\App\Validators\EmailValidator;
use src\App\Validators\PasswordValidator;

session_start();

try {
    if ($argc < 3) {
        throw new \InvalidArgumentException("Usage: php public/index.php <email> <password> <password2>");
    }

    $email = $argv[1];
    $password = $argv[2];
    $password2 = $argv[3];

    $userService = new UserService(new EmailValidator(), new PasswordValidator());

    if (!$userService->validate($email, $password, $password2)) {
        throw new \InvalidArgumentException($userService->getErrorMessage());
    }

    $userId = $userService->registerUser($email, $password);
    $mailService = new MailService();
    $mailService->sendMail($email, "admin@kupujemprodajem.com", "Welcome to our site", "You have successfully registered");

    echo "User successfully registered with ID: $userId\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}