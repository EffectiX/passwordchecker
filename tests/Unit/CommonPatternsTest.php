<?php

use EffectiX\PasswordChecker\Facades\CommonPattern;

it('can evaluate common patterns in presented strings', function() {
    $value = CommonPattern::calculate('password');
    $value2 = CommonPattern::calculate('$password.dead');
    $value3 = CommonPattern::calculate('#myPassword789');
    $value4 = CommonPattern::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');
    $value5 = CommonPattern::calculate('mSK1rldhe9#TuU3EjZRY4QFa-8C?V^YS$o!cWds3f');

    expect($value)->toBeLessThan(-99.0)
    ->and($value2)->toBeLessThan(-19.0)
    ->and($value3)->toBeLessThan(-15.0)
    ->and($value4)->toBeLessThan(-5.0)
    ->and($value5)->toBeGreaterThan(-5.0);
});

