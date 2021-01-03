<?php

namespace App\Classes\UserManagement\FormerPassenger;

use App\Classes\UserManagement\FormerPassenger\Services\FormerPassengersHandler;
use App\Services\UserService;
use App\Classes\UserManagement\FormerPassenger\Services\Get;
use App\Classes\UserManagement\FormerPassenger\Services\Set;
use App\Classes\UserManagement\FormerPassenger\Services\Update;
use Illuminate\Http\Request;

class FormerPassenger
{
    

    public function get($user_id)
    {
        $get = new Get();
        $formerPassengers = $get->get($user_id);

        return $formerPassengers;
    }

    public function set($user_id,$passengers)
    {
        $set = new Set();
        $newPassenger = $set->set($user_id, $passengers);

        return $newPassenger;
    }

    public function update($user_id,$passengers)
    {
        $get = new Get();
        $formerPassengers = $get->get($user_id);

        $update = new Update();
        $updatePassenger = $update->update($formerPassengers, $passengers);

        return $updatePassenger;
    }
}
