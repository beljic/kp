<?php
namespace App\Models;

readonly class User {
    public function __construct(
        private int             $id,
        private string $email,
        private string $passwordHash
    ) {}

    public function getId(): int {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function verifyPassword(string $password): bool {
        return password_verify($password, $this->passwordHash);
    }
}