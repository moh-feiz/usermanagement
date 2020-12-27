<?php

namespace App\Classes\Jwt;

class GetToken
{
    public function get()
    {
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
        $headers = ltrim($headers, 'Bearer');
        $headers = ltrim($headers, ' ');
        return $headers;
    }
}
