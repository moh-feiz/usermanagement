<?php

namespace App\Classes\Jwt\Token;

class Parse
{
    public function parse($token)
    {
        $tokenParts = explode('.', $token);
        $header = base64_decode($tokenParts[0]);
        $payload = base64_decode($tokenParts[1]);
        $signature = $tokenParts[2];

        return [
            'header' => $header,
            'payload' => $payload,
            'signature' => $signature
        ];
    }
}
