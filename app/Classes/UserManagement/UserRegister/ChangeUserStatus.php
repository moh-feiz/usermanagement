<?php


namespace App\Classes\UserManagement\UserRegister;


use App\Services\UserService;

class ChangeUserStatus
{
    const ACTIVE = 10;
    const DEACTIVE = 20;

    public function active($username)
    {
        $user_service = new UserService;
        $user = $user_service->checkUserExist($username);
        $user->status = self::ACTIVE;
        $user->save();
    }

    public function deatctive($username)
    {
        $user_service = new UserService;
        $user = $user_service->checkUserExist($username);
        $user->status = self::DEACTIVE;
        $user->save();
    }
}
