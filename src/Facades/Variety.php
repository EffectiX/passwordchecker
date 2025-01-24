<?php

namespace EffectiX\PasswordChecker\Facades;

use EffectiX\PasswordChecker\Services\PasswordStrength\Variety as VarietyService;
use Illuminate\Support\Facades\Facade;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class Variety extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return VarietyService::class;
    }
}
