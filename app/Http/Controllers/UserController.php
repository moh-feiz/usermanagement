<?php

namespace App\Http\Controllers;

use App\Classes\UserManagement\UserRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        $validator = Validator::make($request->all(), [
            'username' => 'bail|required|unique:users|numeric',
            'email' => 'email:rfc,dns|unique:users',
            'password' => 'required|min:6',
        ], [
            'username.required' => 'شماره موبایل مورد نیاز است',
            'username.unique' => 'این شماره تلفن همراه قبلا ثبت نام شده است',
          //  'username.min' => 'شماره تلفن همراه معتبر نیست',
         //   'username.max' => 'شماره تلفن همراه معتبر نیست',
            'username.numeric' => 'شماره تلفن همراه معتبر نیست',
            'email.unique' => 'این ایمیل قبلا ثبت نام شده است ',
            'email.email' => 'لطفا یک ایمیل معتبر وارد کنید',
            'password.required' => 'وارد کردن رمزعبور الزامیست',
            'password.min' => 'رمزعبور نمیتواند کمتر از 6 کاراکتر باشد',
        ]);

        if ($validator->fails()) {
            $messages = $validator->errors()->getMessages();
            return response()->json(['error' => true, 'message' => $messages]);
        }
        $user_management = new UserRegister;
        $register = $user_management->setUserForSite($request);
        return response()->json($register);
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
