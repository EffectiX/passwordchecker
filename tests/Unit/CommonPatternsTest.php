<?php

use EffectiX\LPS\Facades\LPSCommonPattern;

it('can evaluate common patterns in presented strings', function() {
    $value = LPSCommonPattern::calculate('password');
    $value2 = LPSCommonPattern::calculate('$password.dead');
    $value3 = LPSCommonPattern::calculate('#myPassword789');
    $value4 = LPSCommonPattern::calculate('#R@nd0m!Str1ngz.RuleDaWorldWideWeb$2025');
    $value5 = LPSCommonPattern::calculate('if! f74tgi!8mk% KRpL 9bH0 t36;]');

    expect($value)->toBeLessThan(-99.0)
    ->and($value2)->toBeLessThan(-40.0)
    ->and($value3)->toBeLessThan(-39.0)
    ->and($value4)->toBeLessThan(-20.0)
    ->and($value5)->toBeGreaterThan(-10.0);
});

