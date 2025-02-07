<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use src\app\Resource\Database\Database;
use src\app\Resource\Database\UserRepository;
use src\app\Services\MailService;
use src\app\Services\UserService;
use src\app\Validators\EmailValidator;
use src\app\Validators\PasswordMatchValidator;
use src\app\Validators\PasswordValidator;
use src\app\Validators\RequiredValidator;

session_start();

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

try {
    if ($argc < 4) {
        throw new \InvalidArgumentException("Usage: php public/index.php <email> <password> <password2>");
    }

    $email = $argv[1];
    $password = $argv[2];
    $password2 = $argv[3];

    $validators = [
        'email' => [new RequiredValidator(), new EmailValidator()],
        'password' => [new RequiredValidator(), new PasswordValidator()],
        'password2' => [new RequiredValidator(), new PasswordMatchValidator()]
    ];

    $database = new Database();
    $userRepository = new UserRepository($database);
    $userService = new UserService($userRepository, $validators);

    $data = [
        'email' => $email,
        'password' => $password,
        'password2' => $password2
    ];

    if (!$userService->validate($data)) {
        throw new \InvalidArgumentException($userService->getErrorMessage());
    }

    $userId = $userService->registerUser($email, $password);
    $mailService = new MailService();
    $mailService->sendMail($email, "admin@kupujemprodajem.com", "Welcome to our site", "You have successfully registered");

    echo "User successfully registered with ID: $userId\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}