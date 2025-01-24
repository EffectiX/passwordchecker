<?php

namespace EffectiX\LPS\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use EffectiX\LPS\LPSServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LPSServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
        config()->set('cache.default', 'file');
        putenv('CACHE_DRIVER=file');
        config()->set('password-health-checker.threshold', 25);
    }
}
