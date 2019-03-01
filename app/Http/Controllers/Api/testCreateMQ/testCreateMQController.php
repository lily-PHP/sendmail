<?php

namespace App\Http\Controllers\Api\testCreateMQ;

use App\Http\Controllers\Controller;

class testCreateMQController extends Controller
{
    public function __construct()
    {
        // to do somthing
    }


    /*
     * 模拟创建消息
     */
    public function createMQdate()
    {
        for($i =0;$i<5;$i++){
            $content = [
                'username'=> 'yefanli'.(string)$i,
                'orderId'=>'181218344689923'.(string)$i,
                'advert'=> '【Christmas offer】Automatic multi-function mechanical watch 【gift sunglasses】'.(string)$i,
                'url'=> 'http://www.soldmall.com/804/',
                'address'=> 'No 24, Rainland Place,kollupitiya. Sri Lanka'.(string)$i,
                'price'=> 9999.00,
                'skuList'=> [
                    ['product'=> 'nanshishangwuchenshan','number'=> 1,'Parameters1'=> 'black','Parameters2'=> 'M','Parameters3'=> null,'isMain'=> 0],
                    ['product'=> 'nanshishangwuchenshan','number'=> 1,'Parameters1'=> 'black','Parameters2'=> 'L','Parameters3'=> null,'isMain'=> 0],
                    ['product'=> 'wazi','number'=> 1,'Parameters1'=> 'black','Parameters2'=> null,'Parameters3'=> null,'isMain'=> 1]
                ]
            ];

            $data = [
                'id'                    =>  '1181225032120',
                'toMail'               =>  'ohyevr@163.com',
                'api'                   =>  '/srilanka/purchase',
                'area'                  =>  'srilanka',
                'toName'                =>  'yefanli',
                'content'               =>  $content,
                'msgTime'               =>  time(),
            ];

            $url = 'http://otest08.com/mq/create';
            $code = 'zehui.advert.website.com';
            $time = time();
            $str = 'ghs5dxd4a1xzd5fz4a';
            $sign = md5($str.json_encode($data).$code);

            $headr = [
                "X-PROJECT-ID:".$code,
                "X-AUTH-SIGNATURE:".$sign,
                "X-AUTH-TIMESTAMP:".$time,
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headr);
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => json_encode($data)]);
            $result = (array)json_decode(curl_exec($ch));
            curl_close($ch);

            return $result;
        }
    }
}
