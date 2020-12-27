<?php


namespace App\Classes\Login\Procedure;


use App\Classes\Login\LoginTry\LoginTry;
use App\Classes\Login\SmsTry\SmsTry;
use App\Classes\Login\Validation\MobileValidate;

use App\Classes\UserManagement\UserRegister\UserRegister;
use App\Models\User;
use App\Services\LoginService;
use App\Services\UserService;
use Carbon\Carbon;

class Otp
{

    public function validate($mobile, $ip)
    {
        $mobilevalidate = new MobileValidate;
        return $mobilevalidate->validate($mobile, $ip);
    }

    public function sendVerifyCode($mobile, $ip)
    {
        $logintrysave = new LoginTry;
        $logintrysave->Save($ip, $mobile);
        $checkLoginTry = $logintrysave->loginTryLog($mobile, $ip);
        if (!$checkLoginTry) {
            return ['error' => true, 'message' => 'تلاش بیش از حد مجاز ، شما وارد لیست سیاه شده اید', 'mobile' => $mobile];
        }
        $validate = $this->validate($mobile, $ip);
        if ($validate['error']) {

            return ['error' => true, 'message' => $validate['message'], 'mobile' => $mobile];
        }
        // inja bayad verifycode send konam va baraye user ham in verifyCode ro save konim
        $login_service = new LoginService;
        $verifyCode = $login_service->generateSmsCode();

        $user_service = new UserService;
        $check_user_exist = $user_service->checkUserExist($mobile);
        if ($check_user_exist == null) {
            $user_register = new UserRegister;
            $user_register->userRegisterWithMobile($mobile);
        }
        $user_service->saveSmsForUser($mobile, $verifyCode);

        return ['error' => false, 'message' => $verifyCode, 'mobile' => $mobile];

    }
}
