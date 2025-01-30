<?php

namespace Effectix\PasswordChecker\Http\Livewire;

use Effectix\PasswordChecker\Services\PasswordStrength\PasswordScorer;
use Livewire\Component;

class PasswordStrengthBar extends Component
{
    public $password = '';
    public $score = 0;
    public $scoreMessage = '';
    public $scoreIcon = '';
    public $barColor = 'bg-gray-300';

    public function updatedPassword($value)
    {
        $this->score = PasswordScorer::calculate($value); // Use your existing scoring logic
        $this->updateStrengthBar();
    }

    public function updateStrengthBar()
    {
        // Adjust thresholds as needed
        if ($this->score >= config('passwordchecker.threshold')) {
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.strong');
            $this->barColor = 'bg-green-500 dark:bg-green-400';
            $this->scoreIcon = '🔒';
        } elseif ($this->score >= (config('passwordchecker.threshold') / 2)) {
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.medium');
            $this->barColor = 'bg-yellow-500 dark:bg-yellow-400';
            $this->scoreIcon = '⚠️';
        } else {
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.weak');
            $this->barColor = 'bg-red-500 dark:bg-red-400';
            $this->scoreIcon = '❌';
        }
    }

    public function render()
    {
        return view('effectix/password-checker/password-strength-bar::livewire.password-strength-bar');
    }
}
