<?php
namespace src\App\Validators;

class RequiredFieldValidator implements ValidatorInterface
{
    public static function validate(string $value): bool
    {
        return !empty($value);
    }

    public static function validateMultiple(array $fields): array
    {
        $errors = [];
        foreach ($fields as $key => $value) {
            if (empty($value)) {
                $errors[] = $key . '_required';
            }
        }
        return $errors;
    }
}
