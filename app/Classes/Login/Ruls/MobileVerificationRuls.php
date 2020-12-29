<?php


namespace App\Classes\Login\Ruls;


use App\Models\User;
use App\Services\UserService;
use Carbon\Carbon;

class MobileVerificationRuls
{
    public static function required($mobile, $verifycode)
    {
        if (!$mobile || !$verifycode) {
            return false;
        }
        return true;
    }

    public static function validCode($mobile, $verifycode)
    {
        // inja bayad be service user request bezanim va code ke sms shode ro ba code ke vared karde check konim
        $user_service = new UserService();
        $user = $user_service->checkUserExist($mobile);
        $userVerifyCode = $user->verify_code;
        if ($userVerifyCode == $verifycode) {
            return true;
        }
        return false;

    }

    public static function smsExpire($mobile)
    {
        date_default_timezone_set('Asia/Tehran');
        $user_service = new UserService();
        $user = $user_service->checkUserExist($mobile);
        if ($user) {
            $start_date = strtotime($user->verification_sms_at);
            $now = \Illuminate\Support\Carbon::now()->setTimezone('Asia/Tehran');
            $end_date = strtotime($now);
            if (round(abs($end_date - $start_date) / 60, 2) > 2) {
                return false;
            }
            return true;
        }
        return false;
    }
}
