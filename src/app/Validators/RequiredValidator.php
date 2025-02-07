<?php
namespace src\app\Validators;

class RequiredValidator implements ValidatorInterface
{
    public function validate(mixed $value): bool
    {
        return !empty($value);
    }

    public function getErrorMessage(): string
    {
        return 'Field is required';
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
