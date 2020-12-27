<?php

namespace App\Classes\Login\Validation;

use App\Classes\Login\Ruls\MobileRuls;
use App\Services\LoginService;

class MobileValidate
{
    private static $error_message;

    public function validate($mobile, $ip)
    {

        if (!self::checkExist($mobile) || !self::required($mobile) || !self::mobileValid($mobile) || !self::checkSendSms($mobile) || !self::checkBlackList($ip)) {
            return ['error' => true, 'message' => self::$error_message];
        }
        return ['error' => false, 'message' => 'موفق'];

    }

    private static function checkExist($mobile)
    {
        if (!MobileRuls::checkExist($mobile)) {
            self::$error_message = 'همچین شماره در سیستم موجود نیست';
            return false;
        }
        return true;
    }


    private static function required($mobile)
    {
        if (!MobileRuls::mobileRequired($mobile)) {
            self::$error_message = 'شماره موبایل را وارد کنید';
            return false;
        }
        return true;
    }

    private static function mobileValid($mobile)
    {
        if (!MobileRuls::mobileValid($mobile)) {
            self::$error_message = 'شماره موبایل اشتباه وارد شده است';
            return false;
        }
        return true;
    }

    private static function checkSendSms($mobile)
    {
        if (!MobileRuls::sendSms($mobile)) {
            self::$error_message = 'کد برای شما ارسال شده است';
            return false;
        }
        return true;

    }

    private static function checkBlackList($mobile)
    {
        $login_service = new LoginService;
        if ($login_service->blackList($mobile)) {
            self::$error_message = 'شما به لیست سیاه وارد شدید';
            return false;
        } else {
            return true;
        }
    }

}
