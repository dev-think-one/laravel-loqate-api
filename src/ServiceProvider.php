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
            $key = config('services.loqate.key');
            if (!$key) {
                throw new LoqateException('Please specify api key: services.loqate.key');
            }

            return new LoqateApi($key);
        });
    }
}
