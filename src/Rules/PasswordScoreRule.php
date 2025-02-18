<?php

namespace Effectix\PasswordChecker\Rules;

use Effectix\PasswordChecker\Services\PasswordStrength\PasswordScorer;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordScoreRule implements ValidationRule
{
    protected ?float $threshold;

    public function __construct(?float $threshold = null)
    {

        $this->threshold = (float) ($threshold ?? config('passwordchecker.threshold', 0));
    }

    /**
     * Validate the given value.
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $score = PasswordScorer::calculate($value);

        if ($score < $this->threshold) {
            $fail('effectix/password-checker::validation.password_score')->translate([
                'score' => $score,
                'threshold' => $this->threshold,
            ]);
        }
    }
}
