<?php

namespace App\Classes\UserManagement\FormerPassenger\Services;

use App\Models\FormerPassengers;


class Get
{
    public function get($user_id)
    {
        $passengers = FormerPassengers::where('user_id', '=', $user_id)->get();

        if ($passengers) {
            return $passengers;
        } else {
            return false;
        }
    }
}
