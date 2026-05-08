<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EnumValue implements ValidationRule
{
    public function __construct(private string $enumClass) {}

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $valid = array_column($this->enumClass::cases(), 'value');

        if (! in_array($value, $valid, true)) {
            $fail("La valeur \":input\" n'est pas acceptée pour $attribute. Valeurs acceptées : " . implode(', ', $valid) . '.');
        }
    }
}
