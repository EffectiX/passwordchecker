<?php

use Effectix\PasswordChecker\Services\PasswordStrength\Length;

it('can evaluate length in a string', function () {
    $value = Length::calculate('$password.dead');
    $value2 = Length::calculate('password');
    $value3 = Length::calculate('#myPass789');
    $value4 = Length::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');

    expect($value)->toBe(14.0)
        ->and($value2)->toBe(5.0)
        ->and($value3)->toBe(5.0)
        ->and($value4)->toBe(39.0);
})
    ->group('LengthTest');
