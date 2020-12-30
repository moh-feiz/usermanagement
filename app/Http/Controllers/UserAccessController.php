<?php

namespace App\Http\Controllers;

use App\Classes\UserManagement\UAC\userAccess;
use App\Classes\UserManagement\UAC\UserAccessControl;
use Illuminate\Http\Request;
use App\Services\UserService;


class UserAccessController extends Controller
{
    public function setUserAccess(Request $request)
    {
        $userAccessControl = new UserAccessControl();
        $assignUserAccess = $userAccessControl->set($request->username, $request->access);

        if ($assignUserAccess) {
            return response()->json(['error' => false, 'message' => 'دسترسی های مورد نظر به کاربر داده شد.'], 200);
        } else {
            return response()->json(['error' => true, 'message' => 'ثبت دسترسی کاربر با خطا مواجه شد.'], 400);
        }
    }

    public function getUserAccess(Request $request)
    {
        $userManager = new UserService();
        $user = $userManager->checkUserExist($request->username);

        if ($user->user_access) {
            return response()->json(['error' => false, 'user_access' => $user->user_access], 200);
        } else {
            return response()->json(['error' => false, 'message' => 'کاربر مورد نظر دسترسی ندارد'], 200);
        }
    }
}
