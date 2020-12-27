<?php


namespace App\Helper\ErrorHandel\AuthorizationErrors;


class AuthorizationCodeGrant
{
    public static function UserNotExist(){
        $Error = [ "code" => 1,'error' => 'unauthenticated'];
        return $Error;
    }
    public static function ClientsNotMatch(){
        $Error = [ "code" => 2,'error' => 'ClientsNotMatch'];
        return $Error;
    }

}
