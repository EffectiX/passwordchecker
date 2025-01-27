<?php
namespace Effectix\PasswordStrength\Http\Livewire;

use Livewire\Component;
use YourPackageNamespace\PasswordScorer;  // Your custom password scoring logic

class PasswordStrengthBar extends Component
{
public $password = '';
public $score = 0;
public $scoreMessage = '';
public $barColor = 'bg-gray-300'; // Default color

public function updatedPassword($value)
{
$this->score = PasswordScorer::calculate($value); // Use your existing scoring logic
$this->updateStrengthBar();
}

public function updateStrengthBar()
{
// Adjust thresholds as needed
if ($this->score >= 25) {
$this->scoreMessage = 'Strong';
$this->barColor = 'bg-green-500';
} elseif ($this->score >= 15) {
$this->scoreMessage = 'Medium';
$this->barColor = 'bg-yellow-500';
} else {
$this->scoreMessage = 'Weak';
$this->barColor = 'bg-red-500';
}
}

public function render()
{
return view('password-strength-bar::livewire.password-strength-bar');
}
}
