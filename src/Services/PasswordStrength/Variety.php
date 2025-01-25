<?php

namespace Effectix\PasswordChecker\Services\PasswordStrength;

class Variety
{
    public static function calculate(string $string): float
    {
        $hasLowercase = preg_match('/[a-z]/', $string);
        $hasUppercase = preg_match('/[A-Z]/', $string);
        $hasDigits = preg_match('/\d/', $string);
        $hasSpecialChars = preg_match('/[^\w\d]/', $string);
        $characterTypes = $hasLowercase + $hasUppercase + $hasDigits + $hasSpecialChars;

        switch ($characterTypes) {
            case 4:
                $typeScore = 35;
            case 3:
                $typeScore = 30;
            case 2:
                $typeScore = 25;
            case 1:
                $typeScore = 15;
            default:
                $typeScore = 0;
        }

        return $typeScore + self::varietyScoring($string);
    }

    protected static function varietyScoring(string $string): float
    {
        $array = str_split($string);
        $lowercaseCount = 0;
        $uppercaseCount = 0;
        $digitCount = 0;
        $specialCharCount = 0;
        $spaceCharCount = 0;
        $charCount = [];

        foreach ($array as $value) {
            // Track character occurrences to handle repeated characters
            if (! isset($charCount[$value])) {
                $charCount[$value] = 0;
            }
            $charCount[$value]++;

            // Handle lowercase letters
            if (ctype_lower($value)) {
                $lowercaseCount += 0.5;
            }
            // Handle uppercase letters
            elseif (ctype_upper($value)) {
                $uppercaseCount += 0.5;
            }
            // Handle digits
            elseif (ctype_digit($value)) {
                $digitCount += 0.5;
            }
            // Handle spaces
            elseif (ctype_space($value)) {
                $spaceCharCount += 0.5;
            }
            // Handle special characters (anything not a letter, digit, or space)
            else {
                $specialCharCount += 1; // Special chars are now worth 2 points
            }
        }

        foreach ($charCount as $char => $count) {
            if ($count > 1) {
                if (ctype_alnum($char)) {
                    $lowercaseCount -= 0.5 * ($count - 1);
                    $uppercaseCount -= 0.5 * ($count - 1);
                    $digitCount -= 0.5 * ($count - 1);
                }
            }
        }

        return $lowercaseCount + $uppercaseCount + $digitCount + $specialCharCount + $spaceCharCount;
    }
}
