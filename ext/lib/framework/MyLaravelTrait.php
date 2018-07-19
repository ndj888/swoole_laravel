<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/18
 * Time: 下午10:38
 */

namespace ext\lib\framework;


use com_jjcbs\rpc\lib\RpcClientImpl;

trait MyLaravelTrait
{
    protected function initMyLaravel(array $conf, \swoole_server $swoole , RpcClientImpl $rpcClientImpl)
    {
        $laravel = new MyLaravel($conf);
        $laravel->prepareLaravel();
        $laravel->bindSwoole($swoole);
        $laravel->bindRpcClient($rpcClientImpl);
        return $laravel;
    }
}