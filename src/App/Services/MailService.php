<?php
namespace src\App\Services;

class MailService {
    public function send(string $to, string $from, string $subject, string $message): bool {
        return mail($to, $subject, $message, "From: " . $from);
    }
}