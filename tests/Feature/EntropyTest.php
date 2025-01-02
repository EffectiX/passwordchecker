<?php

use EffectiX\LPHC\Entropy;
use EffectiX\LPHC\Rules\EntropyScoreRule;
use Illuminate\Support\Facades\Validator;

it('class calculates the correct entropy for a given string', function () {
    $entropy = Entropy::calculate('password');
    $entropy1 = Entropy::calculate('Hello World!');
    $entropy2 = Entropy::calculate('p@ssw0rd123456');
    $entropy3 = Entropy::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');

    expect($entropy)->toBeLessThan(3.0)
        ->and($entropy1)->toBeGreaterThan(3.0)
        ->and($entropy2)->toBeGreaterThan(3.5)
        ->and($entropy3)->toBeGreaterThan(4.5);
});

it('class returns 0 for an empty string', function () {
    $entropy = Entropy::calculate('');
    expect($entropy)->toEqual(0.0);
});

it('class returns 0 for a string with only one character', function () {
    $entropy = Entropy::calculate('a');
    expect($entropy)->toEqual(0.0);
});

it('rule validates strings based on custom entropy score', function () {
    // Create an instance of the validation rule with a threshold of 4.5
    $rule = new EntropyScoreRule(4.5);

    // Test string with high entropy
    $result1 = $rule->passes('password', '#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');
    expect($result1)->toBeTrue();  // Should pass the validation since entropy > 4.5

    // Test string with low entropy
    $result2 = $rule->passes('password', 'password');
    expect($result2)->toBeFalse(); // Should fail since entropy < 4.5
});

it('rule uses entropy_score validation rule correctly in the validator and passes', function () {
    // Set up the data
    $data = [
        'password' => '#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025',
    ];

    // Set up the validation rule
    $validator = Validator::make($data, [
        'password' => ['required', 'string', 'entropy_score'],
    ]);

    // Perform the validation
    $isValid = !$validator->fails();

    // Assert the validation passes
    expect($isValid)->toBeTrue();
});

it('uses entropy_score validation rule correctly in the validator and fails', function () {
    // Test with a string that should fail
    $data['password'] = 'password';
    $validator = Validator::make($data, [
        'password' => ['required', 'string', 'entropy_score'],
    ]);

    // Assert the validation fails
    expect($validator->fails())->toBeTrue();
});
