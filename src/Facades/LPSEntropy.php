<?php

namespace EffectiX\LPS\Facades;

use Illuminate\Support\Facades\Facade;
use EffectiX\LPS\Services\PasswordStrength\Entropy;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class LPSEntropy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Entropy::class;
    }
}
