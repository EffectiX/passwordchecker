<?php

namespace EffectiX\LPS\Facades;

use Illuminate\Support\Facades\Facade;
use EffectiX\LPS\Services\PasswordStrength\Length;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class LPSLength extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Length::class;
    }
}
