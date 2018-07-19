<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/18 0018
 * Time: 17:17
 */

namespace ext\service;


use com_jjcbs\lib\Service;
use com_jjcbs\rpc\bean\Ipv4Address;
use com_jjcbs\rpc\bean\RpcClientConfig;
use com_jjcbs\rpc\lib\RpcClientImpl;

class TcpClientService extends Service
{
    /**
     * @var RpcClientImpl
     */
    private static $rpcClient;

    public function __construct()
    {
        $this->exec();
    }

    public function exec()
    {
        // TODO: Implement exec() method.

        // start rpc
        $rpcConfig = new RpcClientConfig();
        $rpcConfig->setServerName(config('app.name'));
        $rpcConfig->setListen(config('rpc.clientListen'));
        $rpcConfig->setPort(config('rpc.clientPort'));
        $rpcConfig->setServerAddress(new Ipv4Address([
            'ip' => config('rpc.serverListen'),
            'port' => config('rpc.serverPort')
        ]));
        $rpcConfig->setTcpUpTime(config('rpc.tcpUpTime'));
        self::$rpcClient = new RpcClientImpl();
        self::$rpcClient->setRpcClientConfig($rpcConfig);
    }

    /**
     * @return RpcClientImpl
     */
    public function getRpcClient(): RpcClientImpl
    {
        return self::$rpcClient;
    }


}