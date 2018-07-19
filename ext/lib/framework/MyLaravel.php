<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/18
 * Time: 下午10:34
 */

namespace ext\lib\framework;


use com_jjcbs\rpc\lib\RpcClientImpl;
use Hhxsv5\LaravelS\Illuminate\Laravel;

class MyLaravel extends Laravel
{
    public function bindRpcClient(RpcClientImpl $rpcClientImpl){
        $this->app->singleton('rpcClientImpl', function () use ($rpcClientImpl) {
            return $rpcClientImpl;
        });
    }
}