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
        $this->publishes([
            __DIR__ . '/../config' => config_path(),
        ], 'config');

        Http::macro('restapi', function () {
            return Http::withToken(config('restapi.api_key'))->baseUrl(config('restapi.base_url'));
        });
    }
    
    public function register()
    {
        $this->registerRestApi();
    }

    public function provides()
    {
        return ['restapi'];
    }

    protected function registerRestApi()
    {
        $this->app->bind('restapi', function ($app) {
            return new RestApiService(config('restapi.base_url'), config('restapi.api_key'));
        });
    }
}
