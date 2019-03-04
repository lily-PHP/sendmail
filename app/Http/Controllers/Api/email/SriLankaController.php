<?php

namespace App\Http\Controllers\Api\email;

use App\Http\Controllers\Api\EmailController;
use Illuminate\Http\Request;

class SriLankaController extends EmailController
{
    /*
     * 下单
     */
    public function purchase()
    {
        $uri = '/srilanka/purchase';
        $info = [
            'view'  =>  'verifyaccount',
            'title' =>  'Verify your Mall Account'
        ];
        $this->sendMail($uri, $info);
    }


    /*
     * 订单确认
     */
    public function confirm()
    {
        $uri = '/srilanka/confirm';
        $info = [
            'view'  =>  'srilankaconfirm',
            'title' =>  'FACEBOOK ORDER CONFIRMATION'
        ];
        $this->sendMail($uri, $info);
    }

    public function testRedis(Request $request)
    {
        return view('verifyaccount', ['data' =>['toName' => 'lily', 'url'=> 'www.srilankashop.top/user/validate?token=a608c50c83191a9be69c355ff5dea261']]);
//        $data = $request -> input();
//        return $data;


//        $redis = app('redis.connection');
//        echo '<pre/>'; var_dump($redis);
    }
}