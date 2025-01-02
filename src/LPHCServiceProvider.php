<?php

namespace EffectiX\LPHC;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class LPHCServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register the Entropy class as a facade
        $this->app->singleton('Entropy', function () {
            return new Entropy();
        });


    }
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/entropy-analyzer.php' => config_path('entropy-analyzer.php')
        ], 'config');

        $this->publishes([
            __DIR__.'/Rules/EntropyScoreRule.php' => app_path('Rules/EntropyScoreRule.php')
        ], 'rules');

        Validator::extend('entropy_score', function ($attribute, $value, $parameters, $validator) {
            $threshold = config('password-health-checker.threshold', 4);
            return (new \EffectiX\LPHC\Rules\EntropyScoreRule($threshold))->passes($attribute, $value);
        });
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
