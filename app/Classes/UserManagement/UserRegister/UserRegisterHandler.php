<?php

namespace App\Classes\UserManagement\UserRegister;

use App\Classes\Login\SmsTry\SmsTry;
use App\Classes\Login\Validation\MobileVerificationValidate;
use App\Classes\Login\Validation\RequestValidate;
use App\Services\LoginService;
use Illuminate\Support\Carbon;


class UserRegisterHandler
{
    public function validation($request)
    {
        $register_validation = new RegisterValidation;
        return $register_validation->validation($request);
    }

    public function verifyCodeValidate($mobile, $verifyCode)
    {
        $MobileVerificationValidate = new MobileVerificationValidate;
        return $MobileVerificationValidate->verifyCodeValidate($mobile, $verifyCode);
    }

    public function registerHandler($request)
    {
        $ip = $request->ip();
        $request_validation = $this->validation($request);
        // inja bayad baraye naghze mahdodiatha if bezaram
        if ($request_validation['error'] == false) {
            $register_try_log = new RegisterTry;
            $register_try_log->save($ip, $request->username, $request->email);
            $register_try = $register_try_log->registerTryLog($request->username, $ip);
            if ($register_try) {
                $login_service = new LoginService;
                $verify_code = $login_service->generateSmsCode();
                $now = Carbon::now()->setTimezone('Asia/Tehran');
                $user_register = new UserRegister;
                $user_register->registerUserForSite($request, $now, $verify_code);

                return ['error' => false, 'message' => $verify_code, 'username' => $request->username];
            } else {
                return ['error' => true, 'message' => 'تلاش بیش از حد مجاز ip شما بلاک شده است', 'username' => $request->username];
            }
        } else {
            return $request_validation;
        }

    }

    public function registerVerify($request)
    {
        $ip = $request->ip();
        $request_validation = new RequestValidate;
        $request_validate = $request_validation->requestVerificationValidate($request->verifycode, $request->username);

        if ($request_validate['error']) {
            return ['error' => true, 'message' => 'کد تایید  یا موبایل وارد نشده است', 'username' => $request->username];
        }
        $sms_try_save = new SmsTry;
        $sms_try_save->Save($ip, $request->username);
        $checkSmsTry = $sms_try_save->smsTryLog($ip, $request->username);
        if (!$checkSmsTry) {
            return ['error' => true, 'message' => 'تلاش بیش از حد مجاز ، شما وارد لیست سیاه شدید', 'username' => $request->username];
        }
        $validate = $this->verifyCodeValidate($request->username, $request->verifycode);
        if ($validate['error']) {
            return ['error' => true, 'message' => $validate['message'], 'username' => $request->username];
        }
        $user_change_status = new ChangeUserStatus();
        $user_change_status->active($request->username);
        return ['error' => false, 'message' => 'ثبت نام با موفقیت به پایان رسید', 'username' => $request->username];

    }

    public function registerPanelAdminHandler($request)
    {
        $request_validation = $this->validation($request);
        if ($request_validation['error'] == false) {
            $user_register = new UserRegister;
            $user_register->registerUserForPanelAdmin($request);
            return ['error' => false, 'message' => 'ثبت نام با موفقیت به پایان رسید', 'username' => $request->username];
        } else {
            return $request_validation;
        }
    }
}
