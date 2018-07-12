<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/12 0012
 * Time: 16:42
 */

namespace ext\lib;


use ext\bean\Ipv4Address;
use ext\bean\msg\RequestDataMsg;
use ext\bean\RpcClientConfig;
use ext\bean\ServerInfo;
use ext\interfaces\RequestData;
use ext\interfaces\ResponseData;
use ext\interfaces\RpcClientInterface;

class RpcClientImpl implements RpcClientInterface
{
    /**
     * 300 ms time out
     */
    const MAX_TIMEOUT = 0.3;
    /**
     * @var RpcClientConfig
     */
    protected $rpcClientConfig;

    /**
     * @param RpcClientConfig $rpcClientConfig
     */
    public function setRpcClientConfig(RpcClientConfig $rpcClientConfig): void
    {
        $this->rpcClientConfig = $rpcClientConfig;
    }


    public function register(ServerInfo $serverInfo): bool
    {
        // TODO: Implement register() method.
    }

    public function unRegister(ServerInfo $serverInfo): bool
    {
        // TODO: Implement unRegister() method.
    }

    public function dnsNameParse(string $serverName): array
    {
        // TODO: Implement dnsNameParse() method.
    }

    public function sendRequest(RequestData $requestData): ResponseData
    {
        // TODO: Implement sendRequest() method.
    }

    /**
     * 启动服务
     */
    public function start(){
        $client = new \Swoole\Client(SWOOLE_UDP );
        $serverAddress = $this->rpcClientConfig->getServerAddress();
        $serverInfo = new ServerInfo();
        $serverInfo->setServerName($this->rpcClientConfig->getServerName());
        $serverInfo->setAddress(new Ipv4Address([
            'ip' => $this->rpcClientConfig->getListen(),
            'port' => $this->rpcClientConfig->getPort()
        ]));
        $data = new RequestDataMsg([
            'eventName' => 'register',
            'data' => $serverInfo->toArray()
        ]);
        if ( ! $client->connect($serverAddress->getIp() , $serverAddress->getPort() , self::MAX_TIMEOUT , 1)){
            throw new \Exception('connect time out');
        }
        $msg = $client->send($data->toJson());
        var_dump($client->recv(1024));
        $client->close();
    }

}