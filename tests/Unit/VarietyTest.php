<?php

use EffectiX\LPS\Facades\LPSVariety;

it('can evaluate variety in a weak string', function () {
    $value = LPSVariety::calculate('password');

    expect($value)->toBeGreaterThan(0.0);
    expect($value)->toBe(2.5);
})
->group('VarietyTest');

it('can evaluate variety in weak/mid strength string', function () {
    $value = LPSVariety::calculate('#myPass789');
    expect($value)->toBe(4.0);
})
    ->group('VarietyTest');

it('can evaluate variety in a weak/mid strength string', function () {
    $value = LPSVariety::calculate('$password.dead');
    expect($value)->toBe(2.0);
})
    ->group('VarietyTest');

it('can evaluate variety in a passphrase string', function () {
    $value = LPSVariety::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');
    expect($value)->toBeGreaterThanOrEqual(7.0);
})
    ->group('VarietyTest');

it('can evaluate variety in a good random string', function () {
    $value = LPSVariety::calculate('if! f74tgi! mk% KRpLbH');
    expect($value)->toBeGreaterThanOrEqual(9.5);
})
    ->group('VarietyTest');

