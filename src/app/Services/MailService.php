<?php
namespace src\app\Services;

class MailService
{
    public function sendMail(string $to, string $from, string $subject, string $message): bool
    {
        return mail($to, $subject, $message, "From: " . $from);
    }
}
