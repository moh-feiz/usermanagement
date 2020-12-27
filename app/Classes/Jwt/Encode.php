<?php

namespace App\Classes\Jwt;

class Encode
{
    public function base64UrlEncode($text)
    {
        return str_replace(
            ['+', '/', '='],
            ['-', '_', ''],
            base64_encode($text)
        );
    }
}
