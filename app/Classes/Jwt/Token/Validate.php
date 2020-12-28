<?php

namespace App\Classes\Jwt\Token;

use App\Classes\Jwt\Blacklist\Blacklist;
use Carbon\Carbon;
use App\Classes\Jwt\EncodeParts;
use App\Services\UserService;

class Validate
{
    /*
        Validate given JWT 
    */
    public function validate($token)
    {
        $secret = env('SECRET');

        //Split and decode the token
        $parseToken = new Parse;
        $parsedToken = $parseToken->parse($token);

        $userManager = new UserService();
        $user = $userManager->checkUserExist(json_decode($parsedToken['payload'])->phone);

        //Put them together and encode again
        $encodeParts = new EncodeParts;
        $encodedParts = $encodeParts->EncodeParts($parsedToken['header'], $parsedToken['payload'], $secret);

        //Rebuild the JWT again
        $jwt = $encodedParts['header'] . "." . $encodedParts['payload'] . "." . $encodedParts['signature'];

        //Verify the given token and the generated one are a match
        $tokenValid = ($jwt === $token);

        //Check the expiration time
        $expiration = Carbon::createFromTimestamp(json_decode($parsedToken['payload'])->exp);
        $tokenExpired = (Carbon::now()->diffInSeconds($expiration, false) < 0);

        //Verify it matches the signature provided in the token
        $signatureValid = ($encodedParts['signature'] === $parsedToken['signature']);

        $blacklist = new Blacklist;
        $existsInBlacklist = $blacklist->exist(json_decode($parsedToken['payload'])->phone);



        if (!$signatureValid || !$tokenValid || $tokenExpired || $existsInBlacklist || !$user) {
            return 'Token is NOT valid.';
        }

        return 'Token is valid.';
    }
}
