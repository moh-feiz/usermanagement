<?php

namespace App\Http\Controllers;

use App\Classes\UserManagement\Profile\ProfileHandler;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function profile(Request $request)
    {
        $profile_handler = new ProfileHandler;
        $profile = $profile_handler->profileHandler($request);
        return response()->json($profile);
    }


}
