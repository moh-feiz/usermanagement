<?php


namespace App\Classes\Login\Verification;


use App\Classes\Login\Ruls\MobileVerificationRuls;
use App\Classes\Login\Validation\RequestValidate;
use App\Services\LoginService;
use App\Services\UserService;
use Illuminate\Http\Request;

class MobileVerification
{


    public function login($request, $role)
    {
        $requestValidate = new RequestValidate;
        $validate = $requestValidate->requestVerificationValidate($request->verifycode, $request->mobile);
        $loginWithVerify = new LoginVerify;

        if (!$validate['error']) {
            $login = $loginWithVerify->loginWithVerify($request->mobile, $request->verifycode, $request->ip(), $role);
            return $login;
        }
        return ['error' => true, 'message' => $validate['message'], 'mobile' => $request->mobile];

    }

    public function resendVerifyCode(Request $request)
    {
        $login_service = new LoginService;
        $verifycode = $login_service->generateSmsCode();
        $user_service = new UserService;
        $check_user_exist = $user_service->checkUserExist($request->mobile);
        if ($check_user_exist) {
            $user_service->saveSmsForUser($request->mobile, $verifycode);
             return ['error' => false, 'message' => $verifycode, 'mobile' => $request->mobile];

        }
        return ['error' => true, 'message' => "چنین شماره همراهی ثبت نشده است!", 'mobile' => $request->mobile];
    }


}
