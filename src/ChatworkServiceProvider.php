<?php

namespace Revolution\NotificationChannels\Chatwork;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\ServiceProvider;

class ChatworkServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->app->when(ChatworkChannel::class)
                  ->needs(Chatwork::class)
                  ->give(function () {
                      return new Chatwork(
                          config('services.chatwork.api_token'),
                          new HttpClient(),
                          config('services.chatwork.endpoint')
                      );
                  });
    }

    /**
     * Register the application services.
     */
    public function register()
    {
    }
}
