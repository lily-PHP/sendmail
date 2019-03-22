<?php

namespace App\Http\Controllers\Api\email;

use App\Http\Controllers\Api\EmailController;
use Illuminate\Http\Request;

class SriLankaController extends EmailController
{
    /*
     * 激活注册邮箱
     */
    public function verifyMail()
    {
        $uri = '/srilanka/verifymail';
        $info = [
            'view'  =>  'verifyaccount',
            'title' =>  'Verify your Mall Account'
        ];
        $this->sendMail($uri, $info);
    }

    /*
     * 找回密码
     */
    public function resetPass()
    {
        $uri = '/srilanka/resetpass';
        $info = [
            'view'  =>  'resetpass',
            'title' =>  'Reset Password'
        ];
        $this->sendMail($uri, $info);

    }

    /*
     * 下单
     */
    public function purchase()
    {
        $uri = '/srilanka/purchase';
        $info = [
            'view'  =>  'srilankapurchase',
            'title' =>  'FACEBOOK PURCHASE ORDER INFORMATION'
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


}