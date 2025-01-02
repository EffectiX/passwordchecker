<?php

namespace EffectiX\LPHC\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \EffectiX\LaravelPasswordHealthChecker\LaravelPasswordHealthChecker
 */
class Entropy extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \EffectiX\LPHC\Entropy::class;
    }
}
