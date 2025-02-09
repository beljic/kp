<?php
namespace src\app\Validators;

interface ValidatorInterface
{
    public function validate(mixed $value): bool;
    public function getErrorMessage(): string;
}
