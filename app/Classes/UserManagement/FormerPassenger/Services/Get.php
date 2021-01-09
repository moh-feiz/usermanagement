<?php

namespace App\Classes\UserManagement\FormerPassenger\Services;

use App\Models\FormerPassengers;


class Get
{
    public function get($username)
    {
        $passengers = FormerPassengers::where('username', '=', $username)->get();

        if ($passengers) {
            return $passengers;
        } else {
            return false;
        }
    }
}
