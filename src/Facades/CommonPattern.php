<?php

namespace EffectiX\PasswordChecker\Facades;

use EffectiX\PasswordChecker\Services\PasswordStrength\CommonPattern as CommonPatternService;
use Illuminate\Support\Facades\Facade;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class CommonPattern extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return CommonPatternService::class;
    }
}
