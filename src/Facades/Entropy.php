<?php

namespace EffectiX\PasswordChecker\Facades;

use Illuminate\Support\Facades\Facade;
use EffectiX\PasswordChecker\Services\PasswordStrength\Entropy as EntropyService;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class Entropy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return EntropyService::class;
    }
}
