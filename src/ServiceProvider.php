<?php

namespace LaravelLoqate;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
            ]);
        }
    }

    public function register()
    {
        $this->app->bind('loqate-api', function ($app) {
            return new LoqateApi(config('services.loqate.key'));
        });
    }
}
