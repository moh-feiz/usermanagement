<?php


namespace App\Classes\UserManagement;

use App\Models\User;
use Illuminate\Http\Request;


class UserRegister
{
    const USER = 10;
    const ADMIN = 20;
    const ACTIVE = 10;
    const DEACTIVE = 20;

    public function setUserForSite(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = self::USER;
        $user->status = self::ACTIVE;
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);

        if ($user->save()) {
            return ['error' => false, 'message' => 'ثبت نام با موفقیت به پایان رسید'];
        } else {
            return ['error' => true, 'message' => 'ثبت نام شما با خطا روبرو شده است'];
        }
    }


    public function setUserForPanelAdmin(Request $request)
    {
        $user = new User();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->role = self::ADMIN;
        $user->status = self::ACTIVE;
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);

        if ($user->save()) {
            return ['error' => false, 'message' => 'ثبت نام با موفقیت به پایان رسید'];
        } else {
            return ['error' => true, 'message' => 'ثبت نام شما با خطا روبرو شده است'];
        }
    }
}
