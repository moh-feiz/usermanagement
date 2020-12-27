<?php

namespace App\Events;

class AccessTokenEvent extends Event
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $user_name;

    public function __construct($user_name)
    {
        $this->user_name = $user_name;
    }


}
