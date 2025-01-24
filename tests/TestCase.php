<?php

namespace EffectiX\PasswordChecker\Tests;

use EffectiX\PasswordChecker\Facades\PasswordChecker;
use Orchestra\Testbench\TestCase as Orchestra;
use EffectiX\PasswordChecker\PasswordCheckerServiceProvider;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            PasswordCheckerServiceProvider::class,
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
