<?php

namespace Effectix\PasswordChecker\Http\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;

class PasswordStrengthBar extends Component
{
    #[Reactive]
    public int $score = 0;

    public string $scoreMessage = '';

    public string $barColor = 'bg-gray-300';

    public int $barWidth = 0;

    public int $threshold = 0;

    public function updateScore(int $value): void
    {
        $this->putTheScore($value);
        $this->updateStrengthBar();
    }

    protected function putTheScore(int $value): void
    {
        $this->score = $value;
    }

    public function updateStrengthBar(): void
    {
        $this->threshold = config('passwordchecker.threshold');
        $score = (int) floor($this->score);

        $this->barWidth = min(max(($score / $this->threshold) * 100, 100), 5); // Directly use the score as width

        if ($this->score === 0) {
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.type');

            return;
        }

        if ($this->score >= $this->threshold) {
            $this->barWidth = 100;
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.strong');
            $this->barColor = 'bg-green-500 dark:bg-green-400';
        } elseif ($this->threshold - $this->score <= 6) {
            $this->barWidth = ($score / $this->threshold) * 100;
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.medium');
            $this->barColor = 'bg-yellow-500 dark:bg-yellow-400';
        } elseif ($this->score < $this->threshold && $this->score >= ($this->threshold / 2)) {
            $this->barWidth = ($score / $this->threshold) * 100;
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.medium');
            $this->barColor = 'bg-yellow-500 dark:bg-yellow-400';
        } else {
            $this->scoreMessage = __('effectix/password-checker::livewire.bar.weak');
            $this->barColor = 'bg-red-500 dark:bg-red-400';
        }

    }

    public function render(): \Illuminate\View\View
    {
        $this->updateStrengthBar();

        return view('effectix/password-checker/password-strength-bar::livewire.password-strength-bar');
    }
}
