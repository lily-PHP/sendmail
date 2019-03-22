<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/*
 * 创建消息推送队列
 */
class CreateQueueController extends Controller
{
    private $ret = [
        'code'      =>  0,
        'msg'       =>  '默认执行失败',
        'success'   =>  false
    ];

    private $getUrl = '';


    /*
     * 队列的ID编写规则:
     * 1        180101      001         001
     * 编码 + 年月日 + 随机三位 + 随机三位
     * 编码:1邮件/ 2短信 / 3其他
     */
    public function __construct()
    {
//        $this->middleware(['Interface']);
    }


    /*
     * 邮件队列
     */
    public function createMailQueue(Request $request)
    {
        $log = new Logger('CreateQueue.createMailQueue');
        $log->pushHandler(new StreamHandler(storage_path('/logs/createMailQueue'.date('Ymd').'.log')));

        $ret = $this->ret;

        $data = $request->input();
        return $data; 
        var_dump($data); die;
//        $data = $request->input('data');
        $log->info('前端接收的数据$data~~~~~~~~~~~~~~~'.json_encode($data));

//        $data = json_decode($data);


//        $toMail = $data->toMail;        // 接收人邮箱
//        $api = $data->api;              // api
////        $area = $data->area;            // 地区
//        $toName = $data->toName;        // 收件人
//        $content = $data->content;      // 发件内容

        $toMail = $data['toMail'];        // 接收人邮箱
        $api = $data['api'];              // api
//        $area = $data->area;            // 地区
        $toName = $data['toName'];        // 收件人
        $content = $data['content'];      // 发件内容

        if(empty($toMail)){
            $ret['msg'] = '收件人邮箱不能为空';
            return $ret;
        }

//        if(empty($area)){
//            $ret['msg'] = '通知区域不能为空';
//            return $ret;
//        }

        if(empty($toName)){
            $ret['msg'] = '收件人不能为空';
            return $ret;
        }

        if(empty($content)){
            $ret['msg'] = '邮件内容不能为空';
            return $ret;
        }

        // 创建队列
        $redis = app('redis')->connection('messageQueue');
        $log->info('$redis~~~~~~~~~~~~~~~~~~~'.json_encode($redis));

        // 检查mailQueue中是否包含当前通知的队列
        $uri = str_replace('/', '', $api);
        $queueName = $uri.'mailQueue';
        $mailQueue = $redis->lrange('mailQueue',0,-1);
        if(!in_array($queueName, $mailQueue))$redis->lpush('mailQueue', $queueName);

        $id = '1'.(string)date('ymd').(string)rand(100,999).(string)rand(100,999);

        $arr = [
            'id'                    =>  $id,
            'toMail'                =>  $toMail,
//            'area'                  =>  $area,
            'api'                   =>  $api,
            'toName'                =>  $toName,
            'content'               =>  json_encode($content),
            'msgTime'               =>  time(),
        ];

        $ret['msg'] = '创建发送失败,无法加入消息队列';
        if($redis->lpush($queueName, $id) && $redis-> hmset($id, $arr)){
            $ret['msg'] = '创建发送成功';
            $ret['success'] = true;
        };

        // 如果不存在锁,则调用
//        $lock = 'lock/'.$queueName.'lock';
//        if(!file_exists($lock)){
//            // 不在生成中
//            $this->get_api('http://otest08.com'.$api);
//        }

        return $ret;
    }


    /*
     * 创建短信队列
     */
    public function createSMSQueue(Request $request)
    {
        $ret = $this->ret;

        $toPhone = $request->input('toPhone');      // 接收人邮箱
        $area = $request->input('area');            // 地区
        $api = $request->input('api');              // api
        $toName = $request->input('toName');        // 收信人
        $content = $request->input('content');      // 发件内容

        if(empty($toPhone)){
            $ret['msg'] = '收信人手机号码不能为空';
            return $ret;
        }

        if(empty($toName)){
            $ret['msg'] = '收信人不能为空';
            return $ret;
        }

        if(empty($content)){
            $ret['msg'] = '短信内容不能为空';
            return $ret;
        }

        // 创建队列
        $redis = app('redis')->connection('messageQueue');

        // 检查smsQueue中是否包含当前通知的队列
        $uri = str_replace('/', '', $api);
        $queueName = $uri.'smsQueue';
        $smsQueue = $redis->lrange('smsQueue',0,-1);
        if(!in_array($queueName, $smsQueue))$redis->lpush('smsQueue', $queueName);

        $id = '2'.(string)date('ymd').(string)rand(100,999).(string)rand(100,999);
        $arr = [
            'id'                    =>  $id,
            'toPhone'               =>  $toPhone,
            'api'                   =>  $api,
            'area'                  =>  $area,
            'toName'                =>  $toName,
            'content'               =>  $content,
            'msgTime'               =>  time(),
        ];

        $ret['msg'] = '创建发送失败,';
        if($redis->lpush('smsQueue', $id) && $redis-> hmset($id, $arr)){
            $ret['msg'] = '创建发送成功';
        };

        // 如果不存在锁,则调用
        $lock = 'lock/'.$queueName.'.lock';
        if(!file_exists($lock)){
            $this->get_api($api);
        }

        return $ret;
    }


    /*
     * 调用接口
     */
    private function get_api($url=false)
    {
        if(!$url)return;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0.1);      // 以超时作为异步执行方案
        curl_exec($ch);
        curl_close($ch);
    }
}
