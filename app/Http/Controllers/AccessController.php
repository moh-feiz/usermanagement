<?php

namespace App\Http\Controllers;

use App\Classes\UserManagement\UAC\UserAccess;
use Illuminate\Http\Request;


class AccessController extends Controller
{
    public function setAccess(Request $request)
    {
        $userAccessManager = new UserAccess();
        $setAccess = $userAccessManager->set($request->name, $request->parent_id);


        if ($setAccess) {
            return response()->json(['error' => false, 'message' => 'دسترسی ثبت شد.'], 200);
        } else {
            return response()->json(['error' => true, 'message' => 'ثبت دسترسی با خطا مواجه شد.'], 400);
        }
    }

    public function softDeleteAccess(Request $request)
    {
        $userAccessManager = new UserAccess();
        $safeDelete = $userAccessManager->softDelete($request->access_id);

        if ($safeDelete) {
            return response()->json(['error' => false, 'message' => 'دسترسی با موفقیت حذف شد.'], 200);
        } else {
            return response()->json(['error' => true, 'message' => 'حذف دسترسی با خطا مواجه شد.'], 400);
        }
    }

    public function alterAccess(Request $request)
    {
        $userAccessManager = new UserAccess();
        $userAccess = $userAccessManager->alter($request->access_id, $request->name, $request->parent_id);

        if ($userAccess) {
            return response()->json(['error' => false, 'message' => 'دسترسی مورد نظر با موفقیت تغییر یافت.'], 200);
        } else {
            return response()->json(['error' => true, 'message' => 'تغییرات دسترسی با خطا مواجه شد.'], 400);
        }
    }
}
