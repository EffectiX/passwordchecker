<?php
namespace EffectiX\PasswordChecker\Services\PasswordStrength;

class Length
{
    public static function calculate(string $string): float
    {
        $length = strlen($string);

        if ($length >= 34) {
            return 30;
        } elseif ($length >= 24) {
            return 20;
        } elseif ($length >= 18) {
            return 18;
        } elseif ($length >= 14) {
            return 14;
        } elseif ($length >= 8) {
            return 10;
        }

        return 0;
    }
}
