<?php

namespace src\app\Helpers;

trait Messages {
    protected array $messages = [
        'email_required' => 'Email adresa je obavezna.',
        'email_invalid' => 'Email adresa nije validna.',
        'password_required' => 'Lozinka je obavezna.',
        'password_mismatch' => 'Lozinke se ne podudaraju.',
        'db_error' => 'Greška pri povezivanju sa bazom podataka.',
        'email_exists' => 'Email adresa već postoji u sistemu.',
        'fraud_detected' => 'Registracija nije moguća zbog sigurnosnih razloga.',
        'registration_success' => 'Registracija uspešna!',
    ];

    public function getMessage(string $key): string {
        return $this->messages[$key] ?? 'Greška';
    }
}
