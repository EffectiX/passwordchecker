<?php
namespace Effectix\LPS\Services\PasswordStrength;

class Entropy {
    /**
     * Calculate the Shannon entropy of a given string.
     *
     * @param  string  $string
     * @return float
     */
    public static function calculate(string $string): float
    {
        $length = strlen($string);
        $frequencies = count_chars($string, 1);

        $entropy = 0.0;
        foreach ($frequencies as $char => $frequency) {
            $probability = $frequency / $length;
            $entropy -= ($probability * log($probability, 2) * 3);
        }

        return (float) round($entropy, 2);
    }
}
