<?php

namespace EffectiX\PasswordChecker\Facades;

use Illuminate\Support\Facades\Facade;
use EffectiX\PasswordChecker\Services\PasswordStrength\Length as LengthService;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class Length extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return LengthService::class;
    }
}
