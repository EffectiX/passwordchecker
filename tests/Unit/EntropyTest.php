<?php

use EffectiX\PasswordChecker\Facades\Entropy;

it('calculates the correct entropy for given strings', function () {
    $entropy = Entropy::calculate('password');
    $entropy1 = Entropy::calculate('Hello World!');
    $entropy2 = Entropy::calculate('p@ssw0rd123456');
    $entropy3 = Entropy::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');
    $entropy4 = Entropy::calculate('if! f74tgi! mk% KRpLbH');

    expect($entropy)->toBeLessThan(10.0)
        ->and($entropy1)->toBeGreaterThan(3.0)
        ->and($entropy2)->toBeGreaterThan(3.5)
        ->and($entropy3)->toBeGreaterThan(4.5)
        ->and($entropy4)->toBeGreaterThan(5.5);
})->group('EntropyTest');

it('will return 0 for an empty string', function () {
    $entropy = Entropy::calculate('');
    expect($entropy)->toEqual(0.0);
})->group('EntropyTest');

it('will return 0 for a string with only one character', function () {
    $entropy = Entropy::calculate('a');
    expect($entropy)->toEqual(0.0);
})->group('EntropyTest');

it('will return 0 for a string with multiple characters that are all the same character', function () {
    $entropy = Entropy::calculate('1111111111111111');
    expect($entropy)->toEqual(0.0);
})->group('EntropyTest');

