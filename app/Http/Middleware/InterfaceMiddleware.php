<?php

namespace App\Http\Middleware;

use Closure;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

header('Access-Control-Allow-Origin:*'); // 允许所有域名跨域
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');

class InterfaceMiddleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        //
    ];

    // 必要的头部信息
    private $requestHead = ['HTTP_X_PROJECT_ID', 'HTTP_X_AUTH_SIGNATURE', 'HTTP_X_AUTH_TIMESTAMP'];

    // 固定的配置ID
    private $projectId = ['erp.website.com', 'zehui.advert.website.com'];

    // 允许跨域的服务器
    private $domain = ['ze-hui.com', 'otest08.com', 'otest02.com', 'srilankashop.top', 'lhydejia.site'];

    // 特定字符串
    private $str = 'ghs5dxd4a1xzd5fz4a';


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $head = [];
        $reqData = $request->input('data');
        $reqData = json_decode($reqData);
        $p_id = $time = $nonce = $sign = false;
        $s_name = $r_uri = false;
        foreach ($_SERVER as $k=>$v){
            if($k == 'SERVER_NAME'){
                $s_n = explode('.', $v);
                $s_name = $s_n[count($s_n) - 2].'.'.$s_n[count($s_n) - 1];
            }
            if(in_array($k, $this->requestHead)){
                $head[$k]=$v;
                if($k == 'HTTP_X_PROJECT_ID'){
                    $p_id = !empty($v) && $v != '' ? $v: false;
                }
                if($k == 'HTTP_X_AUTH_TIMESTAMP'){
                    $time = !empty($v) && $v != '' ? $v: false;
                }
                if($k == 'HTTP_X_AUTH_SIGNATURE'){
                    $sign = !empty($v) && $v != '' ? $v: false;
                }
            };
        }

        if(!in_array($s_name, $this->domain)){
            echo '当前域名不在允许的跨域范围内:::::'.$s_name;
            exit();
        }

        if(count($head) != 3){
            echo '缺少必要的参数!';
            exit();
        }

        if(!$p_id || empty($p_id) || !in_array($p_id, $this->projectId)){
            return $ret = '不合法的请求来源.';
        }

        if(!$time || empty($time) || ($time - time()) > 10){
            return $ret = '请求超时.';
        }

        if(!$sign || empty($sign) || $sign != md5($this->str.json_encode($reqData).$p_id)){
            return $ret = '无效的签名.';
        };

        return $next($request);
    }
}
