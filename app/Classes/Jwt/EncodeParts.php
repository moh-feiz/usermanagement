<?php

namespace App\Classes\Jwt;

use App\Classes\Jwt\Encode;


class EncodeParts
{
    function EncodeParts($header, $payload, $secret)
    {
        $encode = new Encode;
        $base64UrlHeader = $encode->base64UrlEncode($header);
        $base64UrlPayload = $encode->base64UrlEncode($payload);
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = $encode->base64UrlEncode($signature);

        return [
            'header' => $base64UrlHeader,
            'payload' => $base64UrlPayload,
            'signature' => $base64UrlSignature
        ];
    }
}
