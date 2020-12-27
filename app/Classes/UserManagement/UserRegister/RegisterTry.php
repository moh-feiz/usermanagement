<?php


namespace App\Classes\UserManagement\UserRegister;


use App\Models\BlockList;
use Illuminate\Support\Carbon;

class RegisterTry
{
    public function Save($ip, $mobile, $email)
    {
        $loginTry = new \App\Models\RegisterTry;
        $loginTry->ip = $ip;
        $loginTry->mobile = $mobile;
        $loginTry->email = $email;
        $loginTry->save();
    }

    public function registerTryLog($mobile, $ip)
    {
        $dateNow = Carbon::now();
        $date = Carbon::now()->addHours(-1);
        $formatted_date = $date->toDateTimeString();
        $formatted_dateNow = $dateNow->toDateTimeString();
        $registerTry = \App\Models\RegisterTry::where('mobile', $mobile)->whereBetween('created_at', array($formatted_date, $formatted_dateNow))->get();

        if (count($registerTry) >= 5) {
            // inja bayad toye blacklist ye method baraye save bema bedan
            $blockList = new BlockList;
            $blockList->ip = $ip;
            $blockList->mobile = $mobile;
            $blockList->save();
            return false;
        }
        return true;
    }
}
