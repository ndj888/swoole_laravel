<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/19 0019
 * Time: 15:19
 */

namespace ext\fun\api;


use com_jjcbs\lib\ServiceFactory;
use com_jjcbs\rpc\fun\api\OpenApiFun;
use com_jjcbs\rpc\lib\RpcClientImpl;
use Illuminate\Support\Facades\Log;

class OpenApiBaseFun extends OpenApiFun
{
    protected static $apiServiceName;

    public static function __callStatic($name, $arguments)
    {
        $openApi = ServiceFactory::getInstance(static::$apiServiceName , [ServiceFactory::getInstance(RpcClientImpl::class)]);
        try{
            $res = $openApi->send($openApi->getFullUrl($name) , $arguments[0]);
            return $res;
        }catch (\Exception $e){
            Log::error("api call error" . $e->getMessage());
        }
    }


}