<?php

namespace Effectix\PasswordChecker\Tests;

use Effectix\PasswordChecker\PasswordCheckerServiceProvider;
use Livewire\LivewireServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

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
            LivewireServiceProvider::class,
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
