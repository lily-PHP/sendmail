<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Mail;
use App\Mail\baseEmail;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class EmailController extends Controller
{
    protected $company_cn = '深圳市泽汇科技有限公司';
    protected $company_en = 'Shenzhen Zehui Technology Co.LTD';
    protected $address = '中国广东省深圳市龙岗区里石排一巷20号坂田集团商务中心';

    private $thisQueue = null;
    private $queueLen = 20;             // 一分钟发20条


    public function __construct()
    {
        // to do somthing
//        $this->middleware(['Interface']);
    }


    /*
     * 公共发送邮件类
     * 如不适用,则在继承的类里重写该方法
     */
    public function sendMail($uri=false, $info=false)
    {
        $log = new Logger('Email.sendMail');
        $log->pushHandler(new StreamHandler(storage_path('/logs/sendmail'.date('Ymd').'.log')));

        $log->info('开始进入sendMail~~~~');

        $mq = str_replace('/', '', $uri).'mailQueue';
        $log->info('1~~~~~$mq队列名称= ~~~~~'.$mq);

        // 检查锁
        $lock = 'lock/'.$mq.'.lock';
        $log->info('锁文件名~~~~~~~~~~$lock~~~~'.$lock);

        if(file_exists($lock)){
            $log ->info('锁文件还存在，说明正在发送邮件中~~~~~~~');
            // 生产中
            exit();
        }

        // 创建文件锁
        $res = file_put_contents($lock, '');
        $log->info('创建并写入文件锁的字节数=~~~'.$res);

        try{
            $log->info('开始连接Redis，读取队列信息~~~~~~~~~~');

            $redis = app('redis')->connection('messageQueue');
//            var_dump($redis); die;
            $log->info('redis链接~~~~~~'.json_encode($res));
            $llen = $redis->llen($mq);
            $log->info('$llen~~~~~~~~~'.$llen);

            if($llen == 0){
                // 没有要消费的订单
                if (file_exists($lock)){
                    unlink($lock);
                }
                $log->info('没有要发的邮件~~~~');
                exit();
            }

            // 获取指定长度的待处理消息
            $this->thisQueue = $llen >= $this->queueLen ? $redis->lrange($mq, $llen - $this->queueLen, $llen):$redis->lrange($mq, 0, $llen);
//            echo '<pre/>'; var_dump($this->thisQueue); die;
            $log->info('获取指定长度的待处理消息~~~~~~~~~~~~~~~~'.json_encode($this->thisQueue));

            $TQL = count($this->thisQueue);
            $log->info('待处理消息的长度~~~~~~~~~~~~'.$TQL);
            for($i=0;$i<$TQL;$i++){
                $redis->LREM($mq, 0, $this->thisQueue[$i]);
                $mq_data = $redis->hgetall($this->thisQueue[$i]);
                $log->info('$mq_data~~~~~~~~~~~~~~~~~~~'.json_encode($mq_data));

                try{
                    $mqList = [];
                    foreach ($mq_data as $k=>$v){
                        $mqList[$k] = empty($v)? 'null' : $v;
                    }
//                    $mqList = ['toMail'=>'lihaiyandejia@sina.com', 'content' => '测试测试~~~test test ~~~'];

                    if(!Mail::to($mqList['toMail'])->send(new baseEmail([
                        'view'=> $info['view'],
                        'title'=> $info['title'],
                        'content'=>$mqList['content']
//                        'content'=>json_decode($mqList['content'])
                    ]))){
//                        dd(Mail::failures());die;
//                        $log->info('发送邮件错误~~~~~~~~~~~~~~~~'.Mail::failures());

                        $redis->del($this->thisQueue[$i]);
                    }else{
//                        return ok;
                        $log->info('发送邮件成功~~~~~~~~~');
                        $redis->rpush($mq, $this->thisQueue[$i]);
                    };
                } catch(\Exception $e) {
//                    var_dump($e->getMessage()); die;
                    $log->info('$e1111~~~~~~~~~~~~~~~~~~~~~~'.$e->getMessage());
                    $redis->rpush($mq, $this->thisQueue[$i]);
                }
            }
        } catch(\Exception $e) {
            $log->info('$e22222~~~~~~~~~~~~~~~'. $e->getMessage());
            if (file_exists($lock)){
                unlink($lock);
            }
        } finally {
            $this->thisQueue = null;
            if (file_exists($lock)){
                unlink($lock);
            }
        }
    }
}
