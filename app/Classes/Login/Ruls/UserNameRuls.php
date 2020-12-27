<?php


namespace App\Classes\Login\Ruls;


use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserNameRuls
{
    public static function Required($username, $password)
    {
        if (!$username || !$password) {
            return false;
        }
        return true;
    }

    public function userExist($username, $password)
    {
        $fieldName = $this->checkMobileOrEmail($username);
        // inja bayad ye request bzanam be service user va username password in karbaro begiram
        $user = User::where(["$fieldName" => $username])->first();
        if ($user)
            $password = Hash::check($password, $user->password);

        if ($user && $username == $user->email && $password == $user->password) {
            return true;
        }
        return false;
    }

    private function checkMobileOrEmail($username)
    {
//        if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
//            return 'mobile';
//        }
        return 'email';
    }
}
