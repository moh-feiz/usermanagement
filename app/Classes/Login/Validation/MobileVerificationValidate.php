<?php

namespace App\Classes\Login\Validation;

use App\Classes\Login\Ruls\MobileRuls;
use App\Classes\Login\Ruls\MobileVerificationRuls;

class MobileVerificationValidate
{
    private static $error_message;

    public function verifyCodeValidate($mobile, $verifycode)
    {

        if (!self::required($mobile, $verifycode) || !self::smsExpire($mobile) || !self::mobileValid($mobile) || !self::validCode($mobile, $verifycode)) {
            return ['error' => true, 'message' => self::$error_message];
        }
        return ['error' => false, 'message' => 'موفق'];
    }

    private static function required($mobile, $verifycode)
    {
        if (!MobileVerificationRuls::required($mobile, $verifycode)) {
            self::$error_message = 'شماره موبایل یا کد تایید وارد نشده است ';
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

    private static function validCode($mobile, $verifycode)
    {
        if (!MobileVerificationRuls::validCode($mobile, $verifycode)) {
            self::$error_message = 'کد تایید اشتباه وارد شده است';
            return false;
        }
        return true;
    }

    private static function smsExpire($mobile)
    {
        if (!MobileVerificationRuls::smsExpire($mobile)) {
            self::$error_message = 'کد تایید منقضی شده است';
            return false;
        }
        return true;
    }
}
