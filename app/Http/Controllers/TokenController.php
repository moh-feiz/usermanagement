<?php

namespace App\Http\Controllers;

use App\Classes\Jwt\GetToken;
use App\Classes\Jwt\Token;
use App\Classes\Jwt\Token\InValidate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\InvalidTag;

class TokenController extends Controller
{
    /* Generate a JWT Params: $request = role (String), phone (String) */
    public function generate(Request $request)
    {
        $jwt = new Token;
        $token = $jwt->generate($request->role, $request->phone);
        return $token;
    }

    /* Verify given JWT */
    public function verify()
    {
        $getToken = new GetToken;
        $token = $getToken->get();
        $validation = new Token;
        $validation_result = $validation->validate($token);
        return $validation_result;
    }

    /* Invalidate the JWT */
    public function inValidate()
    {
        $getToken = new GetToken;
        $token = $getToken->get();
        $inValidate = new Token;
        $result = $inValidate->inValidate($token);
        return $result;
    }
}
