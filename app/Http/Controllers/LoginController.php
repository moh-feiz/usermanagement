<?php

namespace App\Http\Controllers;

use App\Classes\Jwt\GetToken;
use App\Classes\Jwt\Token;
use App\Classes\Login\LoginHandler;
use App\Classes\Login\LoginFactory;
use App\Classes\Login\LoginTry\LoginTry;
use App\Classes\Login\Validation\MobileValidate;
use App\Classes\Login\SmsTry\SmsTry;
use App\Classes\Login\Verification\MobileVerification;
use App\Services\LoginService;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function SiteLogin(Request $request)
    {
        $role = "user";
        $login_handler = new LoginHandler;
        $login_way = $login_handler->loginType($request, $role);
        return response()->json($login_way);
    }

    public function panellogin(Request $request)
    {
        $role = "admin";
        $login_handler = new LoginHandler;
        $login_way = $login_handler->loginType($request, $role);
        return response()->json($login_way);
    }

    public function MobileVerification(Request $request)
    {
        $role = "user";
        $mobileverification = new MobileVerification;
        $mobile_verification = $mobileverification->Login($request, $role);
        return response()->json($mobile_verification);
    }

    public function ResendVerifyCode(Request $request)
    {
        $mobileverification = new MobileVerification;
        $mobile_verification = $mobileverification->resendVerifyCode($request);
        return response()->json($mobile_verification);
    }


}
