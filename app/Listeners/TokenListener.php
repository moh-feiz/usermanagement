<?php

namespace App\Listeners;

use App\Events\AccessTokenEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TokenListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\AccessTokenEvent  $event
     * @return void
     */
    public function handle(AccessTokenEvent $event)
    {
        \Log::warning("Create AccessToken For: {$event->user_name}");

    }
}
