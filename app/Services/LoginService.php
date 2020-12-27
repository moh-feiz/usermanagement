<?php

namespace App\Services;

use App\Models\LoginTry;
use Illuminate\Support\Carbon;

class LoginService
{
    public function generateSmsCode()
    {
        return rand(10000, 99999);
    }

    public function blackList($ip)
    {
        // inja be blackip service request mizanim age block shode bod behesh message midim

        return false;
    }

    public function checkSmsExpire($mobile)
    {
        // inja bayad be service user request bezanim va check konim ke code monghazi shode ya na

        $checkExpire = ['error' => false];
        return $checkExpire;
    }

}
