<?php
namespace EffectiX\LPHC\Rules;

use Illuminate\Contracts\Validation\Rule;
use EffectiX\LPHC\Entropy;

class EntropyScoreRule implements Rule
{
    protected $threshold;

    /**
     * Create a new rule instance.
     *
     * @param float $threshold
     */
    public function __construct(float $threshold)
    {
        $this->threshold = $threshold;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $entropy = Entropy::calculate($value);

        return $entropy >= $this->threshold;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute entropy score must be at least {$this->threshold}.";
    }
}
