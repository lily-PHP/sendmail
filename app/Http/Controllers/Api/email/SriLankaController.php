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
            'view'  =>  'srilankapurchase',
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
        return view('verifyaccount', ['data' => 'lalalallallllllll']);
        $data = $request -> input();
        return $data;


//        $redis = app('redis.connection');
//        echo '<pre/>'; var_dump($redis);
    }
}