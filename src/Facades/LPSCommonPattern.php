<?php

namespace EffectiX\LPS\Facades;

use EffectiX\LPS\Services\PasswordStrength\CommonPattern;
use Illuminate\Support\Facades\Facade;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class LPSCommonPattern extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CommonPattern::class;
    }
}
