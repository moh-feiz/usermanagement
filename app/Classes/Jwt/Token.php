<?php

namespace App\Classes\Jwt;

use App\Classes\Jwt\Token\Generate;
use App\Classes\Jwt\Token\InValidate;
use App\Classes\Jwt\Token\Validate;

class Token
{
    /*
        Generate JWT for user

        Params :
        $role = String : Role (admin or user)
        $phone = String : Phone number (ex : 09362818100)
    */
    public function generate($role, $phone)
    {
        $generate = new Generate;
        $token = $generate->make($role, $phone);

        return $token;
    }

    /*
        Validate given JWT

        Params :
        $token = String : JWT (ex : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwaG9uZSI6bnVsbCwicm9sZSI6bnVsbCwiZXhwIjoxNjA3NDE0NzE4fQ.wo3Hxx5UBuV_IG-cFrKu25ww0HBFcCjvPqr9eJ2WV9g)
    */
    public function validate($token)
    {
        $validate = new Validate;
        $result = $validate->validate($token);

        return response()->json(['Message' => $result]);
    }

    /*
        Validate given JWT

        Params :
        $token = String : JWT (ex : eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJwaG9uZSI6bnVsbCwicm9sZSI6bnVsbCwiZXhwIjoxNjA3NDE0NzE4fQ.wo3Hxx5UBuV_IG-cFrKu25ww0HBFcCjvPqr9eJ2WV9g)
    */
    public function inValidate($token)
    {
        $inValidate = new InValidate;
        $result = $inValidate->inValidate($token);

        return response()->json(['Message' => $result]);
    }
}
