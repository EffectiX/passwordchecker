<?php
namespace EffectiX\PasswordChecker\Services\PasswordStrength;

use Illuminate\Support\Facades\Cache;

class CommonPattern
{
    protected static string $commonPasswords = __DIR__ . '/../../Common/passwords.txt';
    protected static string $commonNames = __DIR__ . '/../../Common/names.txt';

    protected static string $commonSymbols = __DIR__ . '/../../Common/symbols.txt';

    protected static string $commonNumericals = __DIR__ . '/../../Common/numerical.txt';

    /**
     * @param  string  $filePath
     * @param  string  $string
     * @return float
     * @throws \Exception
     */
    private static function processFile(string $filePath, string $string): float
    {
        $string = trim($string);
        if(!file_exists($filePath)) {
            throw new \Exception('File not found: ' . $filePath);
        }
        $file = fopen($filePath, 'r');

        $score = 0.0;
        while(($line = fgets($file)) !== false) {
            $line = trim($line);
            if (str_contains($string, $line) !== false) {
                $score -= 2.0; // Apply penalty if a common pattern is found and continue scanning for other patterns.
            }

            if ($string === $line){
                $score = -100.0;// apply severe penalty for exact matches and break out of the loop.
                break;
            }
        }
        fclose($file);

        return $score;
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
        $score = self::processFile(self::$commonPasswords, $string)
            + self::processFile(self::$commonNames, $string)
            + self::processFile(self::$commonSymbols, $string)
            + self::processFile(self::$commonNumericals, $string);

        // Ensure maximum penalty of -100.
        if ($score < -100.0) {
            $score = -100.0;
        }

        return $score;
    }
}
