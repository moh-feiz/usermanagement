<?php


namespace App\Classes\UserManagement\UserRegister;

use App\Models\User;
use Illuminate\Http\Request;


class UserRegister
{
    const USER = 10;
    const ADMIN = 20;

    public function registerUserForSite(Request $request, $verification_sms_at = null, $verify_code)
    {
        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role = self::USER;
        $user->status = ChangeUserStatus::DEACTIVE;
        $user->verification_sms_at = $verification_sms_at;
        $user->verify_code = $verify_code;
        $plainPassword = $request->password;
        $user->password = app('hash')->make($plainPassword);
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function registerUserForPanelAdmin(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = self::ADMIN;
        $user->status = ChangeUserStatus::ACTIVE;
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);

        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function userRegisterWithMobile($mobile, $verification_sms_at = null, $verify_code = null)
    {
        $user = new User();
        $user->username = $mobile;
        $user->role = self::USER;
        $user->status = ChangeUserStatus::ACTIVE;
        $user->verification_sms_at = $verification_sms_at;
        $user->verify_code = $verify_code;
        $user->save();
    }

}
