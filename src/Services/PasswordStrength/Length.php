<?php

namespace Effectix\PasswordChecker\Services\PasswordStrength;

class Length
{
    public static function calculate(string $string): float
    {
        $length = strlen($string);

        if ($length >= 12) {
            return $length;
        }

        return 5;
    }
}
