<?php


namespace App\Classes\Login;


use App\Classes\Login\Procedure\Otp;
use App\Classes\Login\Procedure\UserName;

class LoginFactory
{
    public function loginWay($login_way) {
        if ($login_way == 'otp') {
            $way = new Otp();
            return $way;
        } elseif ($login_way == 'username') {
            $way = new UserName();
            return $way;
        }
    }
}
