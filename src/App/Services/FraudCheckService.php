<?php
namespace src\App\Services;

class FraudCheckService {
    public function isFraudulent(string $email, string $ip): bool {
        return false; // Simulated fraud detection
    }
}