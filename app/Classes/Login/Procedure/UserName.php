<?php


namespace App\Classes\Login\Procedure;

use App\Classes\Jwt\Token;
use App\Classes\Login\LoginTry\LoginTry;

use App\Classes\Login\Validation\UserNameValidate;


class UserName
{

    public function validate($username, $password, $ip)
    {
        $user_name_validate = new UserNameValidate;
        return $user_name_validate->validate($username, $password, $ip);
    }

    public function login($username, $password, $ip, $role)
    {
        $login_try_save = new LoginTry;
        $login_try_save->Save($ip, $username);
        $checkLoginTry = $login_try_save->loginTryLog($username, $ip);
        if (!$checkLoginTry) {
            return ['error' => true, 'message' => 'تلاش بیش از حد مجاز ، شما وارد لیست سیاه شدید', 'username' => $username];
        }
        $validate = $this->validate($username, $password, $ip);
        if ($validate['error']) {
            return ['error' => true, 'message' => $validate['message'], 'username' => $username];
        }
        // inja bayad ye request bezanam be service authentication va token ro daryaft mikonam

        $jwt = new Token;
        $token = $jwt->generate($role, $username);

        return ['error' => false, 'message' => $token, 'username' => $username];
    }

}
