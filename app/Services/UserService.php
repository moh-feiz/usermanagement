<?php


namespace App\Services;


use App\Classes\UserManagement\UserRegister;
use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function saveSmsForUser($mobile, $verifyCode)
    {

        $mytime = Carbon::now('Asia/Tehran');
        $now = $mytime->toDateTimeString();
        $user = User::where('username', $mobile)->first();
        $user->verify_code = $verifyCode;
        $user->verification_sms_at = $now;
        $user->save();


    }

    public function checkUserExist($mobile)
    {
        $user = User::where('username', $mobile)->first();

        if ($user) {
            return $user;
        }
        return false;
    }
}
