<?php
namespace src\app\Services;

class FraudCheckService {
    public function isFraudulent(string $email, string $ip): bool {
        return false; // Simulated fraud detection
    }
}