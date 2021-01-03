<?php

namespace App\Classes\UserManagement\FormerPassenger\Services;

class Update
{
    public function update($formerPassengers, $passenger)
    {

        $passenger_id = $passenger['passenger_id'];

        foreach ($formerPassengers as $formerPassenger) {

            if ($formerPassenger->id == $passenger_id) {

                $formerPassenger->first_name_fa = $passenger['first_name_fa'];
                $formerPassenger->last_name_fa = $passenger['last_name_fa'];
                $formerPassenger->social_code = $passenger['social_code'];
                $formerPassenger->gender = $passenger['gender'];
                $formerPassenger->birthday = $passenger['birthday'];

                if ($passenger['first_name_en']) {
                    $formerPassenger->first_name_en = $passenger['first_name_en'];
                }

                if ($passenger['last_name_en']) {
                    $formerPassenger->last_name_en = $passenger['last_name_en'];
                }

                if ($passenger['mobile']) {
                    $formerPassenger->mobile = $passenger['mobile'];
                }

                if ($passenger['passport_number']) {
                    $formerPassenger->passport_number = $passenger['passport_number'];
                    $formerPassenger->country_passport = $passenger['country_passport'];
                    $formerPassenger->expire_date_passport = $passenger['expire_date_passport'];
                }

                if (!$formerPassenger->save()) {
                    return false;
                }
            }
        }
        return true;
    }
}
