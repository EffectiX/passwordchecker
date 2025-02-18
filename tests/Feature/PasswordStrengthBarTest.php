<?php

use Effectix\PasswordChecker\Http\Livewire\PasswordStrengthBar;
use Livewire\Livewire;

it('renders livewire component successfully', function () {
    Livewire::test(PasswordStrengthBar::class)->assertStatus(200)->assertSee('Write a password to get it scored...');
});

it('renders component with correct messages', function () {

    Livewire::test(PasswordStrengthBar::class, ['score' => 5])
        ->assertSet('score', 5)
        ->call('updateStrengthBar')
        ->assertStatus(200)
        ->assertSee('Weak password detected!');

    Livewire::test(PasswordStrengthBar::class, ['score' => 25])
        ->assertSet('score', 25)
        ->call('updateStrengthBar')
        ->assertStatus(200)
        ->assertSee('Finally!');
});
