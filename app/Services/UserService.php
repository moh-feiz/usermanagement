<?php


namespace App\Services;


use App\Models\User;
use Carbon\Carbon;

class UserService
{
    public function saveSmsForUser($mobile, $verifyCode)
    {

        $check_exist = $this->checkUserExist($mobile);
        if($check_exist){
            $mytime = Carbon::now('Asia/Tehran');
            $now = $mytime->toDateTimeString();
            $user = User::where('username', $mobile)->first();
            $user->verify_code = $verifyCode;
            $user->verification_sms_at = $now;
            $user->save();
            return true;
        }
        return false;


    }

    public function checkUserExist($mobile)
    {
        // inja bayad be service user request bzanim va bebinim in shomare mobile exist hast ya na
        $user = User::where('username', $mobile)->first();
        if ($user) {
            return true;
        }
        return false;
    }
}
