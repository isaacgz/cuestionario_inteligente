<?php
use Illuminate\Support\Facades\DB;


function getUserName($id){
    return DB::table('sys_users')
            ->select('name')
            ->where('id', $id)
            ->first();
}

function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

function lastDay($year, $mounth){
    switch(intval($mounth)){
            case 1: $lastDay=31;
                    break;
            case 2:
                    if (($year%4)==0 && (($year%100)!=0 || ($year%400)==0)) $lastDay=29; else $lastDay=28;
                break;
            case 3: $lastDay=31;
                    break;
            case 4: $lastDay=30;
                    break;
            case 5: $lastDay=31;
                    break;
            case 6: $lastDay=30;
                    break;
            case 7: $lastDay=31;
                    break;
            case 8: $lastDay=31;
                    break;
            case 9: $lastDay=30;
                    break;
            case 10: $lastDay=31;
                    break;
            case 11: $lastDay=30;
                    break;
            case 12: $lastDay=31;
                    break;
        }//switch

    return($lastDay);
}

 