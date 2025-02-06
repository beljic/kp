<?php
namespace src\App\Validators;

interface ValidatorInterface
{
    public function validate(mixed $value): bool;
    public function getErrorMessage(): string;
}