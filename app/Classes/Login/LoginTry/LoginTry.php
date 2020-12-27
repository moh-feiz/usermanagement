<?php


namespace App\Classes\Login\LoginTry;


use App\Models\BlockList;
use Illuminate\Support\Carbon;

class LoginTry
{
    public function Save($ip, $mobile)
    {
        $loginTry = new \App\Models\LoginTry();
        $loginTry->ip = $ip;
        $loginTry->mobile = $mobile;
        $loginTry->save();
    }

    public function loginTryLog($mobile, $ip)
    {
        $dateNow = Carbon::now();
        $date = Carbon::now()->addHours(-1);
        $formatted_date = $date->toDateTimeString();
        $formatted_dateNow = $dateNow->toDateTimeString();
        $loginTry = \App\Models\LoginTry::where('mobile', $mobile)->whereBetween('created_at', array($formatted_date, $formatted_dateNow))->get();

        if (count($loginTry) >= 5) {
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
