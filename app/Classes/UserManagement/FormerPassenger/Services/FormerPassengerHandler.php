<?php

namespace App\Classes\UserManagement\FormerPassenger\Services;

use App\Classes\UserManagement\FormerPassenger\FormerPassenger;

class FormerPassengerHandler
{
    public function handle($user_id, $passengers)
    {
        $errors = [];
        $errors['update'] = [];
        $errors['set'] = [];

        $formerPassengerService = new FormerPassenger();

        foreach ($passengers as $key => $value) {

            if ($value['passenger_id']) {
                $handler =  $formerPassengerService->update($user_id, $value);

                if (!$handler) {
                    array_push($errors['update'], $key);
                }
            } else {
                $handler = $formerPassengerService->set($user_id, $value);

                if (!$handler) {
                    array_push($errors['set'], $key);
                }
            }
        }
        return $errors;
    }
}
