<?php

namespace EffectiX\LPS\Facades;

use EffectiX\LPS\Services\PasswordStrength\Variety;
use Illuminate\Support\Facades\Facade;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class LPSVariety extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Variety::class;
    }
}
