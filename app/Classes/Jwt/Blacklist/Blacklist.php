<?php

namespace App\Classes\Jwt\Blacklist;

use Illuminate\Support\Facades\Cache;

class Blacklist
{
    public function exist($phone)
    {
        if (Cache::has($phone)) {
            return true;
        } else {
            return false;
        }
    }

    public function add($phone, $token, $expire)
    {
        if ($this->exist($phone)) {
            return false;
        } else {
            $result = Cache::put($phone, $token, $expire);
        }

        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
