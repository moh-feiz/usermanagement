<?php


namespace App\Classes\UserManagement\UserRegister;


use App\Classes\Login\Validation\RequestValidate;
use Illuminate\Support\Facades\Validator;

class RegisterValidation
{
    public function validation($request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['bail', 'required', 'unique:users', 'regex:/^(0){1}(9){1}[0-9]{9}+$/'],
            'email' => 'email:rfc,dns|unique:users',
            'password' => 'required|min:6',
        ], [
            'username.required' => 'شماره موبایل مورد نیاز است',
            'username.regex' => 'شماره موبایل معتبر نیاز است',
            'username.unique' => 'این شماره تلفن همراه قبلا ثبت نام شده است',
            'email.unique' => 'این ایمیل قبلا ثبت نام شده است ',
            'email.email' => 'لطفا یک ایمیل معتبر وارد کنید',
            'password.required' => 'وارد کردن رمزعبور الزامیست',
            'password.min' => 'رمزعبور نمیتواند کمتر از 6 کاراکتر باشد',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->getMessages();
            return ['error' => true, 'message' => $messages, 'username' => $request->username];
        } else {
            return ['error' => false, 'message' => '', 'username' => $request->username];
        }
    }


}
