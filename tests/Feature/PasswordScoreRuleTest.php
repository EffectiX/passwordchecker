<?php

use Effectix\PasswordChecker\Rules\PasswordScoreRule;
use Illuminate\Support\Facades\Validator;

it('uses password_security_score validation rule correctly with globally configured threshold in the validator and passes', function () {
    $data = ['passwordA' => '#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025'];

    $validator = Validator::make(
        $data,
        [
            'passwordA' => ['required', 'string', new PasswordScoreRule],
        ]
    );

    expect($validator->fails())->toBeFalse();
});

it('uses default threshold validation rule correctly and fails', function () {
    $data['passwordB'] = 'password';
    $validator = Validator::make($data, [
        'passwordB' => ['required', 'string', new PasswordScoreRule],
    ]);

    expect($validator->fails())->toBeTrue();
});

it('validates strings based on custom threshold for password security score on weak pass', function () {
    $data = ['passwordC' => 'password'];

    $rule = new PasswordScoreRule(20.0);
    $rules = ['passwordC' => $rule];

    $validator = Validator::make($data, $rules);
    expect($validator->fails())->toBeTrue();
});

it('validates strings based on custom threshold for password security score on passphrase', function () {
    $rule = new PasswordScoreRule(15.0);
    $data = ['passwordD' => '#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025'];
    $rules = ['passwordD' => $rule];

    $validator = Validator::make($data, ['passwordD' => $rules]);
    expect($validator->fails())->toBeFalse();
});

it('validates strings based on default threshold for password security score on random string', function () {
    $rule = new PasswordScoreRule;
    $data = ['passwordE' => 'if!f74tgi!mk%KRpLbH'];
    $rules = ['passwordE' => $rule];

    $validator = Validator::make($data, ['passwordE' => $rules]);
    expect($validator->fails())->toBeFalse();
});

it('fails validation and presents error message "in English"', function () {
    app()->setLocale('en');
    $data = ['passwordF' => 'password'];
    $validator = Validator::make($data, [
        'passwordF' => ['required', 'string', new PasswordScoreRule(100)],
    ]);

    expect($validator->fails())
        ->toBeTrue()
        ->and($validator->errors()->first('passwordF'))
        ->toContain('field had a score of');
});

it('fails validation and presents error message "en Español"', function () {
    app()->setLocale('es');
    $data = ['passwordF' => 'password'];
    $validator = Validator::make($data, [
        'passwordF' => ['required', 'string', new PasswordScoreRule(100)],
    ]);

    expect($validator->fails())
        ->toBeTrue()
        ->and($validator->errors()->first('passwordF'))
        ->toContain('tuvo una puntuación de');
});
