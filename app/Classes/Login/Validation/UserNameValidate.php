<?php


namespace App\Classes\Login\Validation;


use App\Classes\Login\Ruls\MobileRuls;
use App\Classes\Login\Ruls\UserNameRuls;
use App\Services\LoginService;

class UserNameValidate
{
    private static $error_message;

    public function validate($username, $password, $ip)
    {
        if (!self::required($username, $password) || !self::userExist($username, $password) || !self::checkBlackList($ip)) {
            return ['error' => true, 'message' => self::$error_message];
        }
        return ['error' => false, 'message' => 'موفق'];
    }

    private static function required($username, $password)
    {
        if (!UserNameRuls::Required($username, $password)) {
            self::$error_message = 'نام کاربری و رمز عبور را وارد نمایید';
            return false;
        }
        return true;
    }

    private static function userExist($username, $password)
    {
        $userExist = new UserNameRuls;
        if (!$userExist->userExist($username, $password)) {
            self::$error_message = 'کاربری با این اطلاعات یافت نشد';
            return false;
        }
        return true;
    }

    private static function checkBlackList($ip)
    {
        $login_service = new LoginService;
        if ($login_service->blackList($ip)) {
            self::$error_message = 'شما به لیست سیاه وارد شدید';
            return false;
        } else {
            return true;
        }
    }
}
