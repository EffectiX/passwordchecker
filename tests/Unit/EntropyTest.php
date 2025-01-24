<?php

use EffectiX\LPS\Facades\LPSEntropy;

it('calculates the correct entropy for given strings', function () {
    $entropy = LPSEntropy::calculate('password');
    $entropy1 = LPSEntropy::calculate('Hello World!');
    $entropy2 = LPSEntropy::calculate('p@ssw0rd123456');
    $entropy3 = LPSEntropy::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');
    $entropy4 = LPSEntropy::calculate('if! f74tgi! mk% KRpLbH');

    expect($entropy)->toBeLessThan(10.0)
        ->and($entropy1)->toBeGreaterThan(3.0)
        ->and($entropy2)->toBeGreaterThan(3.5)
        ->and($entropy3)->toBeGreaterThan(4.5)
        ->and($entropy4)->toBeGreaterThan(5.5);
})->group('EntropyTest');

it('will return 0 for an empty string', function () {
    $entropy = LPSEntropy::calculate('');
    expect($entropy)->toEqual(0.0);
})->group('EntropyTest');

it('will return 0 for a string with only one character', function () {
    $entropy = LPSEntropy::calculate('a');
    expect($entropy)->toEqual(0.0);
})->group('EntropyTest');

it('will return 0 for a string with multiple characters that are all the same character', function () {
    $entropy = LPSEntropy::calculate('1111111111111111');
    expect($entropy)->toEqual(0.0);
})->group('EntropyTest');

