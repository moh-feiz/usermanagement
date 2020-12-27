<?php

namespace App\Classes\Jwt\Token;

use App\Classes\Jwt\Blacklist\Blacklist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class InValidate
{
    public function inValidate($token)
    {
        $parseToken = new Parse;
        $parsedToken = $parseToken->parse($token);

        $tokenExpiresAt = Carbon::createFromTimestamp(json_decode($parsedToken['payload'])->exp);
        $minutesToExpire = Carbon::now()->diffInMinutes($tokenExpiresAt);
        $expire = Carbon::now()->addMinutes($minutesToExpire);

        $phone = json_decode($parsedToken['payload'])->phone;

        $blacklist = new Blacklist;
        $addToBlacklist = $blacklist->add($phone, $token, $expire);

        if ($addToBlacklist) {
            return 'Token blacklisted.';
        }
        return 'Token blacklisting failed.';
    }
}
