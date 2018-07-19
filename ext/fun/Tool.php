<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/17 0017
 * Time: 11:32
 */

namespace ext\fun;


use Illuminate\Http\Request;

class Tool
{

//随机数
    public static function getCheckCode($length = 6)
    {
        $min = pow(10, ($length - 1));
        $max = pow(10, $length) - 1;
        return mt_rand($min, $max);

    }

    public static function getRequestParam(Request $request){
        return json_decode($request->getContent() , true);
    }

    /**
     * 获取 uuid 订单号
     * @param string $pre
     * @return string
     */
    public static function getOrderSn(string $pre){
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $pre . $uuid;
    }
}