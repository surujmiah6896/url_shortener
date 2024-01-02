<?php

use App\Models\Url;

if (!function_exists('appUrl')) {
    function appUrl($url)
    {
        $base_url = url('');

        return $base_url . '/key/' . $url;
    }
}


if(!function_exists('urlExist')){
    function urlExist($url){

        $url_exist = Url::where('user_id',auth()->id())->where('original_url', $url->original_url)->first();

        if($url_exist){
            return true;
        }else{
            return false;
        }
    }
}
