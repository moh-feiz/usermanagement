<?php


namespace App\Classes\UserManagement\UAC;

use App\Services\UserService;


class UserAccessControl
{
    public function set($username, $access)
    {
        $userManager = new UserService();
        $user = $userManager->checkUserExist($username);

        $user->user_access = $access;

        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

  
}
