<?php

namespace App\Classes\UserManagement\FormerPassenger\Services;

use App\Classes\UserManagement\FormerPassenger\FormerPassenger;

class FormerPassengerHandler
{
    public function handle($username, $passengers)
    {
        $errors = [];
        $errors['update'] = [];
        $errors['set'] = [];

        $formerPassengerService = new FormerPassenger();

        foreach ((array)$passengers as $key => $value) {

            if ($value['passenger_id']) {
                $handler = $formerPassengerService->update($username, $value);

                if (!$handler) {
                    array_push($errors['update'], $key);
                }
            } else {
                $handler = $formerPassengerService->set($username, $value);

                if (!$handler) {
                    array_push($errors['set'], $key);
                }
            }
        }
        return $errors;
    }

}
