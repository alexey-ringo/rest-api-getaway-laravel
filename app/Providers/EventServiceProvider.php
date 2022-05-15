<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Http\Client\Events\RequestSending' => [
            'App\Listeners\HttpClient\LogRequestSending',
        ],
        'Illuminate\Http\Client\Events\ResponseReceived' => [
            'App\Listeners\HttpClient\LogResponseReceived',
        ],
        'Illuminate\Http\Client\Events\ConnectionFailed' => [
            'App\Listeners\HttpClient\LogConnectionFailed',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
