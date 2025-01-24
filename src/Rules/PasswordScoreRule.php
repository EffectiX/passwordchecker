<?php

namespace EffectiX\LPS\Rules;

use EffectiX\LPS\Facades\LPSCommonPattern;
use EffectiX\LPS\Facades\LPSLength;
use EffectiX\LPS\Facades\LPSVariety;
use EffectiX\LPS\Facades\LPSEntropy;
use Illuminate\Contracts\Validation\ValidationRule;

class PasswordScoreRule implements ValidationRule
{
    protected null|float $threshold;
    protected bool $debug;

    /**
     * Create a new rule instance.
     *
     * @param  float|null  $threshold
     * @param  boolean  $debug
     */
    public function __construct(float $threshold = null, $debug = false)
    {
        $this->debug = $debug;

        $this->threshold = (float) ($threshold ?? config('password-health-checker.threshold'));
    }

    /**
     * Validate the given value.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, \Closure $fail): void
    {
        $entropyScore = LPSEntropy::calculate($value);
        $lengthScore = LPSLength::calculate($value);
        $varietyScore = LPSVariety::calculate($value) * 2;
        $patternScore = LPSCommonPattern::calculate($value);

        $score = $entropyScore + $lengthScore + $varietyScore + $patternScore;

        if ($this->debug) {
            $data = [
                $attribute => $value,
                'score' => $score." = ".$entropyScore." + ".$lengthScore." + ".$varietyScore." + ".$patternScore,
                'threshold' => $this->threshold,
                'result' => $score < $this->threshold ? 'Fail' : 'Pass',
            ];
            print_r($data);
        }

        if ($score < $this->threshold) {
            $fail($this->message($score));
        }
    }

    public function message($score): string
    {
        return "The :attribute field had a score of $score. It must be at least ".$this->threshold.". Use a stronger password by including upper and lowercase letters, numbers and symbols. Use spaces at most once. Be as random as possible and use the longest thing you can come up with.";
    }
}
