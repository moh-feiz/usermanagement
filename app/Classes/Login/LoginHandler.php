<?php


namespace App\Classes\Login;

use App\Classes\Login\Validation\RequestValidate;

class LoginHandler
{
    public function loginType($request, $role)
    {

        $requestValidate = new RequestValidate;
        $validate = $requestValidate->requestLoginValidate($request);

        if (!$validate['error']) {
            $login_factory = new LoginFactory;
            $loginWay = $login_factory->loginWay("$request->type");
            if ($request->type == "username") {
                $login = $loginWay->login($request->username, $request->password , $request->ip() , $role);
                return $login;
            }
            if ($request->type == "otp") {
                $login = $loginWay->sendVerifyCode($request->mobile , $request->ip() , $role);
                return $login;
            }
        }
        return ['error' => true , 'message' => $validate['message'] , 'username' => '' , 'mobile' => ''];


    }
}
