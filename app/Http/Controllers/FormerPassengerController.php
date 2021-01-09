<?php

namespace App\Http\Controllers;

use App\Classes\UserManagement\FormerPassenger\Services\Get;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Classes\UserManagement\FormerPassenger\FormerPassenger;
use App\Classes\UserManagement\FormerPassenger\Services\FormerPassengerHandler;


class FormerPassengerController extends Controller
{

    public function get(Request $request)
    {
        $getFormer = new Get();
        $formerPassengers = $getFormer->get($request->username);
        return response()->json(['error' => false, 'message' => 'لیست مسافرین سابق', 'former_passengers' => $formerPassengers], 200);
    }

    public function set(Request $request)
    {
//echo"<pre>";
//print_r($request->all());die();
        $handler = new FormerPassengerHandler();
        $handle = $handler->handle($request->username, $request->passengers);

        return $handle;
    }
}
