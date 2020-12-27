<?php

namespace App\Classes\Jwt;


class Parts
{
    /*
        Generate header for JWT 
    */
    public function header()
    {
        $header = json_encode([
            'typ' => 'JWT',
            'alg' => 'HS256'
        ]);
        return $header;
    }


    /*
        Generate payload for JWT

        Params :
        $role = String : Role (admin or user)
        $phone = String : Phone number (ex : 09362818100)

    */
    public function payload($role, $phone)
    {
        //Set expire to 20 minutes later from now (Tehran, Iran timezone)
        date_default_timezone_set("Asia/Tehran");
        $expire = strtotime("+20 minutes", strtotime(date('Y-m-d H:i:s')));

        $payload = json_encode([
            'phone' => $phone,
            'role' => $role,
            'exp' => $expire
        ]);

        return $payload;
    }
}
