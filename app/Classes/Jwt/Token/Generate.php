<?php

namespace App\Classes\Jwt\Token;

use App\Classes\Jwt\Parts;
use App\Classes\Jwt\EncodeParts;


class Generate
{
    public function make($role, $phone)
    {
        $secret = env('SECRET');

        $getParts = new Parts;
        $header = $getParts->header();
        $payload = $getParts->payload($role, $phone);

        $encodeParts = new EncodeParts;
        $encodedParts = $encodeParts->EncodeParts($header, $payload, $secret);

        $jwt = $encodedParts['header'] . "." . $encodedParts['payload'] . "." . $encodedParts['signature'];

        return $jwt;
    }
}
