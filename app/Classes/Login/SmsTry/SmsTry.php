<?php


namespace App\Classes\Login\SmsTry;


use App\Models\BlockList;
use Illuminate\Support\Carbon;

class SmsTry
{
    public function Save($ip, $mobile)
    {
        $loginTry = new \App\Models\SmsTry();
        $loginTry->ip = $ip;
        $loginTry->mobile = $mobile;
        $loginTry->save();
    }

    public function smsTryLog($ip ,$mobile)
    {
        $dateNow = Carbon::now();
        $date = Carbon::now()->addMinutes(-2);
        $formatted_date = $date->toDateTimeString();
        $formatted_dateNow = $dateNow->toDateTimeString();
        $loginTry = \App\Models\SmsTry::where('mobile', $mobile)->whereBetween('created_at', array($formatted_date, $formatted_dateNow))->get();

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
