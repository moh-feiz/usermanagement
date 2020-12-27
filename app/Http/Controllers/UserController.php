<?php

namespace App\Http\Controllers;



use App\Classes\Login\Verification\MobileVerification;
use App\Classes\UserManagement\UserRegister\UserRegister;
use App\Classes\UserManagement\UserRegister\UserRegisterHandler;

use App\Classes\UserManagement\User as UserManagementUser;


use App\Models\User;
use App\Services\UserService;
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

            //  'username.min' => 'شماره تلفن همراه معتبر نیست',
            //   'username.max' => 'شماره تلفن همراه معتبر نیست',
            'username.numeric' => 'شماره تلفن همراه معتبر نیست',

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


    public function get(Request $request)
    {
        $userManager = new UserService();
        $user = $userManager->checkUserExist($request->username);

        if ($user) {
            return response()->json(['user' => $user, 'message' => 'کاربر یافت شد'], 201);
        } else {
            return response()->json(['error' => true, 'message' => 'کاربر مورد نظر یافت نشد'], 201);
        }
    }

    public function setPassword(Request $request)
    {
        $userManager = new UserManagementUser();
        $setPassowrd = $userManager->setPassowrd($request->all());

        return response()->json($setPassowrd);
    }

    public function update(Request $request)
    {
        $userManager = new UserManagementUser();
        $updateUser =  $userManager->update($request->all());

        if ($updateUser) {
            return response()->json(['error' => false, 'message' => 'تغییرات با موفقیت ثبت شد'], 201);
        } else {
            return response()->json(['error' => true, 'message' => 'خطا در ویرایش اطلاعات'], 201);
        }
    }

    public function test(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $plainPassword = $request->input('password');
        $user->password = app('hash')->make($plainPassword);

        if ($user->save()) {
            return response()->json(['user' => $user, 'message' => 'CREATED'], 201);
        } else {
            return response()->json(['message' => 'User Registration Failed!'], 409);
        }
    }

}
