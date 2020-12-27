<?php

namespace App\Classes\Login\Ruls;

use App\Models\User;
use App\Services\LoginService;
use App\Services\UserService;

class MobileRuls
{
    public static function mobileValid($mobile)
    {
        if (preg_match('/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/', $mobile)
            || preg_match('/^(9){1}[0-9]{9}+$/', $mobile)) {
            return true;
        }
        return false;
    }

    public static function mobileRequired($mobile)
    {
        if ($mobile) {
            return true;
        }
        return false;
    }

    public static function checkExist($mobile)
    {
        // inja bayad be service user request bzanim va bebinim in shomare mobile exist hast ya na
        $user_service = new UserService;
        $user = $user_service->checkUserExist($mobile);

        if ($user) {
            return true;
        }
        return false;
    }

    public static function sendSms($mobile)
    {
        // inja bayad be service user request bzanim va check konim sms ta 2min ghable barash rafte ya na
        return true;
    }

}
