<?php

namespace Effectix\PasswordChecker\Rules;

use Effectix\PasswordChecker\Services\PasswordStrength\PasswordScorer;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordScoreRule implements ValidationRule
{
    protected ?float $threshold;

    protected bool $debug;

    /**
     * Create a new rule instance.
     *
     * @param  bool  $debug
     */
    public function __construct(?float $threshold = null, $debug = false)
    {
        $this->debug = $debug;

        $this->threshold = (float) ($threshold ?? config('passwordchecker.threshold'));
    }

    /**
     * Validate the given value.
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $score = PasswordScorer::calculate($value);

        if ($this->debug) {
            $data = [
                $attribute => $value,
                'score' => $score.' = ('.$entropyScore.' + '.$lengthScore.' + '.$varietyScore.' + '.$patternScore.') ÷ 4',
                'threshold' => $this->threshold,
                'result' => $score < $this->threshold ? 'Fail' : 'Pass',
            ];
            $data = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            var_dump($data);

        }

        if ($score < $this->threshold) {
            $fail('effectix/password-checker::validation.password_score')->translate([
                'score' => $score,
                'threshold' => $this->threshold,
            ]);
        }
    }

    public function message(): string
    {
        return 'The :attribute field had a score of :score. It must be greater than :threshold. Use a stronger password by including upper and lowercase letters, numbers and symbols. Use spaces at most once. Be as random as possible and use the longest thing you can come up with.';
    }
}
