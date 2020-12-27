<?php

namespace App\Classes\UserManagement;

use App\Models\User as ModelsUser;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;
use stdClass;

class User
{
    public function setPassowrd($userInformation)
    {

        $userManager = new UserService();
        $user = $userManager->checkUserExist($userInformation['username']);

        $response = new stdClass;

        if ($user->email == '' || $user->email == null) {
            $response->error = true;
            $response->message = 'ایمیل برای کاربر ثبت نشده';
            $response->status = 400;
            return $response;
        }

        $user->password = Hash::make($userInformation['password']);

        if ($user->save()) {
            $response->error = false;
            $response->message = 'ایمیل با موفقیت برای کاربر ثبت شد';
            $response->status = 200;
            return $response;
        } else {
            $response->error = true;
            $response->message = 'خطا در ثبت رمز عبور';
            $response->status = 400;
            return $response;
        }
    }

    public function update($userInformation)
    {
        $userManager = new UserService();
        $user = $userManager->checkUserExist($userInformation['username']);

        $user->email = $userInformation['email'];

        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }
}
