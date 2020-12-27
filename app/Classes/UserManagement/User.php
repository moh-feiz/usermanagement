<?php

namespace App\Classes\UserManagement;

use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\Hash;

class User
{
    public function get($username)
    {
        $user = ModelsUser::where('username', '=', $username)->first();

        if ($user) {
            return $user;
        }

        return false;
    }

    //SET PASSWORD FOR A USER WHO DOES NOT HAVE A PASSWORD
    public function setPassowrd($userInformation)
    {
        //GET USER
        $user = $this->get($userInformation->username);

        //SET PASSWORD
        $user->password = Hash::make($$userInformation->password);

        //SAVE AND RETURN
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }

    //UPDATE USER INFO (PROFILE)
    public function update($userInformation)
    {
        //GET USER
        $user = $this->get($userInformation->username);

        //CHANGE USER INFORMATION
        $user->email = $userInformation->email;


        //SAVE AND RETURN
        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }
}
