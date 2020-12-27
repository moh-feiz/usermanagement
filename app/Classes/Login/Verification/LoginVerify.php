<?php


namespace App\Classes\Login\Verification;


use App\Classes\Jwt\Token;
use App\Classes\Login\SmsTry\SmsTry;
use App\Classes\Login\Validation\MobileVerificationValidate;

class LoginVerify
{
    public function verifyCodeValidate($mobile, $verifyCode)
    {
        $MobileVerificationValidate = new MobileVerificationValidate;
        return $MobileVerificationValidate->verifyCodeValidate($mobile, $verifyCode);
    }

    public function loginWithVerify($mobile, $verifyCode, $ip, $role)
    {

        $sms_try_save = new SmsTry;
        $sms_try_save->Save($ip, $mobile);
        $checkSmsTry = $sms_try_save->smsTryLog($ip, $mobile);
        if (!$checkSmsTry) {
            return ['error' => true, 'message' => 'تلاش بیش از حد مجاز ، شما وارد لیست سیاه شدید', 'mobile' => $mobile];
        }
        $validate = $this->verifyCodeValidate($mobile, $verifyCode);
        if ($validate['error']) {
            return ['error' => true, 'message' => $validate['message'], 'mobile' => $mobile];
        }
        // inja bayad ye request bezanam be service authentication va token ro daryaft mikonam

        $jwt = new Token;
        $token = $jwt->generate($role, $mobile);
        return ['error' => false, 'message' => $token, 'mobile' => $mobile];
    }

}
