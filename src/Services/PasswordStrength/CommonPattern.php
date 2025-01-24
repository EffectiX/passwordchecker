<?php
namespace EffectiX\LPS\Services\PasswordStrength;

use Illuminate\Support\Facades\Cache;

class CommonPattern
{
    protected static $commonPasswords = [];

    /**
     * Load the common passwords from the txt file into the array.
     * This is done only once and caches the result using Cache.
     */
    protected static function loadCommonPasswords()
    {
        return self::$commonPasswords = Cache::remember('common_passwords', 1440, function () {
            $filePath = __DIR__ . '/../../Common/passwords.txt';

            if (file_exists($filePath)) {
                $contents = file_get_contents($filePath);

                return array_map('trim', explode(PHP_EOL, $contents));
            }

            return [];
        });
    }

    /**
     * Calculate the penalty based on common patterns.
     *
     * @param string $string The password string
     *
     * @return float The penalty score
     */
    public static function calculate(string $string): float
    {
        // Load common passwords if they haven't been loaded yet
        self::loadCommonPasswords();
        $score = 0;
        // Check if the password contains any common pattern
        foreach (self::$commonPasswords as $pattern) {
            if (str_contains($string, $pattern) !== false) {
                $score -= 2; // Apply penalty if a common pattern is found
            }

            if ($string === $pattern){
                $score = -100;// apply severe penalty for exact match
                break;
            }
        }

        return $score; // return total score
    }
}
