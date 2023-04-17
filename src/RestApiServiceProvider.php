<?php

namespace TigerHeck\RestApi;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use TigerHeck\RestApi\Console\RestApiWebhookSubscribeCommand;

class RestApiServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->configurePublishing();
        }
    }
    
    public function register()
    {
        $this->registerRestApi();
    }

    public function provides()
    {
        return ['restapi'];
    }

    public function configurePublishing()
    {
        $this->publishes([
            __DIR__.'/../config/restapi.php' => config_path('restapi.php'),
        ], 'config');

        $timestamp = date('Y_m_d_His', time());

        $this->publishes([
            __DIR__.'/database/migrations/create_restapi_tokens_table.php' => $this->app->databasePath()."/migrations/{$timestamp}_create_restapi_tokens_table.php",
        ], 'migrations');
    }

    protected function registerRestApi()
    {
        $this->app->bind('restapi', function ($app) {
            return new RestApiService();
        });
    }
}
