<?php

namespace EffectiX\LPHC\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use EffectiX\LPHC\LPHCServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            LPHCServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');
    }
}
