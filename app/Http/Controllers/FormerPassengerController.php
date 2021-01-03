<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Classes\UserManagement\FormerPassenger\FormerPassenger;
use App\Classes\UserManagement\FormerPassenger\Services\FormerPassengerHandler;


class FormerPassengerController extends Controller
{
    private $user_id;

    public function __construct(Request $request)
    {
        $getUser = new UserService();
        $user = $getUser->checkUserExist($request->username);
        $this->user_id = $user->id;
    }

    public function get(Request $request)
    {
        $getFormer = new FormerPassenger();
        $formerPassengers = $getFormer->get($this->user_id);

        if ($formerPassengers) {
            return response()->json(['error' => false, 'former_passengers' => $formerPassengers], 200);
        } else {
            return response()->json(['error' => true, 'message' => 'مسافر سابق وجود ندارد.'], 400);
        }
    }

    public function handler(Request $request)
    {
        $handler = new FormerPassengerHandler();
        $handle = $handler->handle($this->user_id, $request->passengers);

        return $handle;
    }
}
