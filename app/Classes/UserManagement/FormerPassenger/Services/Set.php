<?php

namespace App\Classes\UserManagement\FormerPassenger\Services;

use App\Models\FormerPassengers;


class Set
{
    public function set($user_id, $passenger)
    {
        $newPassenger = new FormerPassengers();

        $newPassenger->user_id = $user_id;
        $newPassenger->first_name_fa = $passenger['first_name_fa'];
        $newPassenger->last_name_fa = $passenger['last_name_fa'];
        $newPassenger->first_name_en = $passenger['first_name_en'];
        $newPassenger->last_name_en = $passenger['last_name_en'];
        $newPassenger->social_code = $passenger['social_code'];
        $newPassenger->mobile = $passenger['mobile'];
        $newPassenger->passport_number = $passenger['passport_number'];
        $newPassenger->country_passport = $passenger['country_passport'];
        $newPassenger->expire_date_passport = $passenger['expire_date_passport'];
        $newPassenger->gender = $passenger['gender'];
        $newPassenger->birthday = $passenger['birthday'];

        if (!$newPassenger->save()) {
            return false;
        }
        return true;
    }
}
