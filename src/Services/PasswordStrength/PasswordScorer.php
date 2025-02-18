<?php

namespace Effectix\PasswordChecker\Services\PasswordStrength;

class PasswordScorer
{
    public static function calculate(string $password): float
    {
        $entropyScore = Entropy::calculate($password) * 2;
        $lengthScore = Length::calculate($password) * 2;
        $varietyScore = Variety::calculate($password) * 2;
        $patternScore = CommonPattern::calculate($password);

        return ($entropyScore + $lengthScore + $varietyScore + $patternScore) / 4.0;
    }
}