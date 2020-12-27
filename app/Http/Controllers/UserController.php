<?php

namespace App\Http\Controllers;


use App\Classes\Login\Verification\MobileVerification;
use App\Classes\UserManagement\UserRegister\UserRegister;
use App\Classes\UserManagement\UserRegister\UserRegisterHandler;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Http\ResponseFactory;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    public function siteregister(Request $request)
    {

        $user_register_handler = new UserRegisterHandler;
        $register = $user_register_handler->registerHandler($request);
        return response()->json($register);
    }

    public function registerverify(Request $request)
    {
        $user_register_handler = new UserRegisterHandler;
        $register = $user_register_handler->registerVerify($request);
        return response()->json($register);
    }

    public function ResendVerifyCode(Request $request)
    {
        $mobileverification = new MobileVerification;
        $mobile_verification = $mobileverification->resendVerifyCode($request);
        return response()->json($mobile_verification);
    }

    public function panelregister(Request $request)
    {
        $validation = Validator::make($request->all(), [
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

        if ($validation->fails()) {
            $messages = $validation->errors()->getMessages();
            return response()->json(['error' => true, 'message' => $messages]);
        }
        $user_management = new UserRegister;
        $register = $user_management->setUserForSite($request);
        return response()->json($register);
    }


}
