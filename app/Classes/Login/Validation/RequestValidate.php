<?php


namespace App\Classes\Login\Validation;


class RequestValidate
{

    public function requestLoginValidate($request)
    {
        if (!$request->type) {
            return ['error' => true, 'message' => 'نوع ورود فرستاده نشده است'];
        }
        if ($request->type != "otp" && $request->type != "username") {
            return ['error' => true, 'message' => 'نوع ورود اشتباه است'];
        }
        if ($request->type == 'otp' && !$request->mobile) {

            return ['error' => true, 'message' => 'شماره موبایل وارد نشده است'];
        }
        if ($request->type == 'username' && (!$request->username || !$request->password)) {
            return ['error' => true, 'message' => 'نام کاربری و رمز عبور وارد نشده است'];
        }
        return ['error' => false, 'message' => 'موفق'];
    }

    public function requestVerificationValidate($request)
    {
        if (!$request->verifycode || !$request->mobile) {
            return ['error' => true, 'message' => 'کد تایید  یا موبایل وارد نشده است'];
        }
        return ['error' => false, 'message' => 'موفق'];
    }

}
