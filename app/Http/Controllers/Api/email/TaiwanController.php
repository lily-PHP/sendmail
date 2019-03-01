<?php

namespace App\Http\Controllers\Api\email;

use App\Http\Controllers\Api\EmailController;
use Mail;
use App\Mail\baseEmail;
use Illuminate\Http\Request;

class TaiwanController extends EmailController
{


    /*
     * 下单
     */
    public function purchase(Request $request)
    {
        $req = $request->input('pushData');
        echo $req;
//        Mail::to('ohyevr@163.com')->send(new baseEmail([
//            'view'=>'hahaha',
//            'title'=> '下单成功提示',
//            'content'=>[
//                'username'=> 'yefanli',
//                'age' => 28,
//                'sex' => 'man'
//            ]
//        ]));
    }


    /*
     * 订单确认
     */
    public function confirm()
    {
        echo 'confirm';
        Mail::to('ohyevr@163.com')->send(new baseEmail(['view'=>'hahaha']));
    }
}