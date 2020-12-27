<?php

namespace App\Providers;

use Laravel\Lumen\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \App\Events\AccessTokenEvent::class => [
            \App\Listeners\AccessTokenListener::class,
            \App\Listeners\TokenListener::class,
        ],
    ];

}
