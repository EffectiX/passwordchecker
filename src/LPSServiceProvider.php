<?php

namespace EffectiX\LPS;

use EffectiX\LPS\Services\PasswordStrength\CommonPattern;
use EffectiX\LPS\Services\PasswordStrength\Entropy;
use EffectiX\LPS\Rules\PasswordScoreRule;
use EffectiX\LPS\Services\PasswordStrength\Length;
use EffectiX\LPS\Services\PasswordStrength\Variety;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class LPSServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the facades
        $this->app->singleton('LPSEntropy', Entropy::class);
        $this->app->singleton('LPSLength', Length::class);
        $this->app->singleton('LPSCommonPattern', CommonPattern::class);
        $this->app->singleton('LPSVariety', Variety::class);


    }
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/entropy-analyzer.php' => config_path('entropy-analyzer.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/Rules/EntropyScoreRule.php' => app_path('Rules/EntropyScoreRule.php')
        ], 'rules');
    }

    /**
     * Determine if the provider is deferred.
     *
     * @return bool
     */
    public function isDeferred()
    {
        return false; // Set to false if your provider is not deferred.
    }
}
