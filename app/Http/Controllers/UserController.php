<?php

namespace App\Http\Controllers;

use App\Classes\Login\Verification\MobileVerification;
use App\Classes\UserManagement\UserRegister\UserRegisterHandler;
use App\Classes\UserManagement\User as UserManagementUser;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function siteRegister(Request $request)
    {

        $user_register_handler = new UserRegisterHandler;
        $register = $user_register_handler->registerHandler($request);
        return response()->json($register);
    }

    public function panelRegister(Request $request)
    {
        
        $user_register_handler = new UserRegisterHandler;
        $register = $user_register_handler->registerPanelAdminHandler($request);
        return response()->json($register);
    }

    public function mobileVerification(Request $request)
    {
        $user_register_handler = new UserRegisterHandler;
        $register = $user_register_handler->registerVerify($request);
        return response()->json($register);
    }

    public function resendVerifyCode(Request $request)
    {
        $mobileverification = new MobileVerification;
        $mobile_verification = $mobileverification->resendVerifyCode($request);
        return response()->json($mobile_verification);
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
        $updateUser = $userManager->update($request->all());

        if ($updateUser) {
            return response()->json(['error' => false, 'message' => 'تغییرات با موفقیت ثبت شد'], 201);
        } else {
            return response()->json(['error' => true, 'message' => 'خطا در ویرایش اطلاعات'], 201);
        }
    }

    public function safeDelete(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['bail', 'required', 'regex:/^(0){1}(9){1}[0-9]{9}+$/'],
        ], [
            'username.required' => 'شماره موبایل مورد نیاز است',
            'username.regex' => 'شماره موبایل معتبر نیاز است',
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors()->getMessages();
            return ['error' => true, 'message' => $messages, 'username' => $request->username];
        } else {
            $user_manager = new UserManagementUser;
            $safe_deleted = $user_manager->safeDelete($request);
            return response()->json($safe_deleted);
        }

    }

    public function checkAccess(Request $request)
    {
        die('ok');
    }


}
