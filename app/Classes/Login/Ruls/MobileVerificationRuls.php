<?php


namespace App\Classes\Login\Ruls;


use App\Models\User;
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
        $user = User::where('username', $mobile)->first();
        $userVerifyCode = $user->verify_code;
        if ($userVerifyCode == $verifycode) {
            return true;
        }
        return false;

    }

    public static function smsExpire($mobile)
    {
        date_default_timezone_set('Asia/Tehran');
        $user = User::where('username', $mobile)->first();
        $start_date = strtotime($user->verification_sms_at);
        $end_date = strtotime(date('Y-m-d H:i:s'));
        if (round(abs($end_date - $start_date) / 60, 2) > 2) {

            return false;
        }
        return true;
    }
}
