<?php

use Effectix\PasswordChecker\Services\PasswordStrength\Variety;

it('can evaluate variety in a weak string', function () {
    $value = Variety::calculate('password');

    expect($value)->toBeGreaterThan(0.0);
    expect($value)->toBe(2.5);
})
    ->group('VarietyTest');

it('can evaluate variety in weak/mid strength string', function () {
    $value = Variety::calculate('#myPass789');
    expect($value)->toBe(4.0);
})
    ->group('VarietyTest');

it('can evaluate variety in a weak/mid strength string', function () {
    $value = Variety::calculate('$password.dead');
    expect($value)->toBe(2.0);
})
    ->group('VarietyTest');

it('can evaluate variety in a passphrase string', function () {
    $value = Variety::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');
    expect($value)->toBeGreaterThanOrEqual(7.0);
})
    ->group('VarietyTest');

it('can evaluate variety in a good random string', function () {
    $value = Variety::calculate('if! f74tgi! mk% KRpLbH');
    expect($value)->toBeGreaterThanOrEqual(9.5);
})
    ->group('VarietyTest');
