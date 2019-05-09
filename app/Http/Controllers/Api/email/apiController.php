<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/9
 * Time: 18:05
 */
namespace App\Http\Controllers\Api\email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

header('Access-Control-Allow-Origin:*'); // 允许指定域名跨域
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:x-requested-with,content-type');
class apiController extends Controller
{
    public function getMailData(Request $request)
    {
        $data = $request -> input();
        var_dump($data);
    }


}