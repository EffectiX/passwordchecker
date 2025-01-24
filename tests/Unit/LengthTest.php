<?php

use EffectiX\LPS\Facades\LPSLength;

it('can evaluate length in a string', function() {
    $value = LPSLength::calculate('$password.dead');
    $value2 = LPSLength::calculate('password');
    $value3 = LPSLength::calculate('#myPass789');
    $value4 = LPSLength::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');

    expect($value)->toBe(14.0)
    ->and($value2)->toBe(10.0)
    ->and($value3)->toBe(10.0)
    ->and($value4)->toBe(30.0);
})
->group('LengthTest');
