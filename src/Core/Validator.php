<?php

namespace App\Core;

class Validator
{
    private static ?Validator $instance = null;
    private array $errors = [];

    private function __construct() {}

    public static function getInstance(): Validator
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function validate(array $data, array $rules): array
    {
        $this->errors = [];
        foreach ($rules as $field => $rule) {
            $ruleParts = explode('|', $rule);
            foreach ($ruleParts as $part) {
                $validationResult = $this->validateField($part, $field, $data[$field] ?? null);
                if ($validationResult !== true) {
                    $this->errors[$field][] = $validationResult;
                }
            }
        }
        return $this->errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    private function validateField(string $part, string $field, $value): string|bool
    {
        if ($part === 'required' && (is_null($value) || $value === '')) {
            return "$field is required.";
        }
        if ($part === 'int' && !filter_var($value, FILTER_VALIDATE_INT)) {
            return "$field must be an integer.";
        }
        if ($part === 'numeric' && !is_numeric($value)) {
            return "$field must be a numeric value.";
        }
        if ($part === 'date' && !strtotime($value)) {
            return "$field must be a valid date.";
        }
        if (str_starts_with($part, 'string') && !is_string($value)) {
            return "$field must be a string.";
        }
        if (str_contains($part, 'string') && $value !== null && strlen((string)$value) === 0) {
            return "$field cannot be empty.";
        }
        if (str_starts_with($part, 'max')) {
            $maxLength = (int)explode(':', $part)[1];
            if ($value !== null && strlen((string)$value) > $maxLength) {
                return "$field must be shorter than $maxLength characters.";
            }
        }
        return true;
    }

}
