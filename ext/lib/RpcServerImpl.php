<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/12 0012
 * Time: 15:04
 */

namespace ext\lib;

use ext\bean\msg\RequestDataMsg;
use ext\bean\msg\ResponseDataMsg;
use ext\bean\RpcServerConfig;
use ext\bean\ServerInfo;
use ext\interfaces\RpcServerInterface;

/**
 * Rpc server 端实现
 * Class RpcServerImpl
 * @package ext\lib
 */
class RpcServerImpl implements RpcServerInterface
{
    /**
     * 每30s 广播一次
     */
    const broadcastTime = 30 * 1000;
    /**
     * @var RpcServerConfig $rpcServerConfig
     */
    protected $rpcServerConfig;
    /**
     * @var \Swoole\Table
     */
    protected $serverTable;

    /**
     * [serverName1 = > [0 , 1] , serverName2 => [0,1]]
     * @var array
     */
    protected $serverNameIndexArr = [];
    /**
     * [$fd1 => $serverName1]
     * @var array
     */
    protected $fdServerInfo = [];


    public function getConfig(): RpcServerConfig
    {
        // TODO: Implement getConfig() method.
        return $this->rpcServerConfig;
    }

    public function setConfig(RpcServerConfig $rpcServerConfig)
    {
        // TODO: Implement setConfig() method.
        $this->rpcServerConfig = $rpcServerConfig;
    }

    public function serverStart()
    {
        // TODO: Implement serverStart() method.
        if (empty($this->rpcServerConfig)) throw new \Exception("请设置rpcServerConfig");
        //set serverTable
        $this->serverTable = new \Swoole\Table($this->rpcServerConfig->getMaxServerMapSize());
        $serv = new \Swoole\Server($this->rpcServerConfig->getListen()
            , $this->rpcServerConfig->getPort(), SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

        // 建立连接
        $serv->on('connect', function ($serv, $fd) {
            echo 'Client-Connect.\n';
            swoole_timer_tick(self::broadcastTime , function(int $timer_id , $param) use($serv , $fd){
                echo '开始广播最新dns信息';
                $serv->send(\json_encode($this->fdServerInfo));
            });
        });
        // 收到消息
        $serv->on('receive', function ($serv, $fd, $from_id, $data) {
            try {
                $raw = new RequestDataMsg(\json_decode($data));
                switch ($raw->getEventName()) {
                    case 'register':
                        $body = new ServerInfo($raw->getData());
                        $index = $fd;
                        $this->serverNameIndexArr[$body->getServerName()] = $index;
                        $this->fdServerInfo[$fd] = $body->toArray();
                        $signKey = md5($body->getServerName() . $index);
                        if ($this->serverTable->get($signKey) == false) {
                            // key not exist
                            // set info to table
                            $this->serverTable->set($signKey, $body->toArray());
                        }
                        break;
                    case 'unRegister':
                        $body = new ServerInfo($raw->getData());
                        $serverKey = md5($body->getServerName());
                        $arr = $this->serverTable->get($serverKey);
                        array_push($arr, $body->toArray());
                        // set info to table
                        $this->serverTable->set($serverKey, $arr);
                        break;
                        break;
                    /**
                     * DNS 查询
                     */
                    case 'selectDns' :
                        $sn = $raw->getData()['serverName'];
                        if ( !array_key_exists($sn , $this->serverNameIndexArr)){
                            throw new \Exception('server not found');
                        }
                        $data = $this->serverTable->get($sn . $this->dnsSelect($this->serverNameIndexArr[$sn]));
                        $serv->send($fd , \json_encode($data));
                        break;
                    default:
                        $msg = new ResponseDataMsg([
                            'eventName' => 'noNone',
                            'data' => ['msg' => 'not found event name']
                        ]);
                        $serv->send($fd, $msg->toJson());
                        break;
                }
            } catch (\Exception $e) {
                echo 'error: ' . $e->getMessage() . '\n';
                $serv->close();
            }
        });
        // 关闭连接
        $serv->on('close', function ($serv, $fd) {
            echo 'Client-Close.\n';
            try {
                $this->unRegister($this->fdServerInfo[$fd]);
            } catch (\Exception $e) {
                echo 'close error ' . $e->getMessage();
            } finally {
                unset($this->fdServerInfo[$fd]);
            }
        });
        // 启动服务
        $serv->start();
    }


    /**
     * 注销当前服务
     * @param ServerInfo $info
     */
    private function unRegister(ServerInfo $info)
    {
        $serverName = $info->getServerName();
        $indexArr = $this->serverNameIndexArr[$serverName];
        foreach ($indexArr as $i) {
            $signKey = md5($serverName . $i);
            $body = $this->serverTable->get($signKey);
            if ($body['address']['port'] == $info->getAddress()->getProt() && $body['address']['ip'] == $info->getAddress()->getIp()) {
                // found
                $this->serverTable->del($signKey);
                break;
            }
        }
    }


    /**
     * dns 负载均衡选择算法
     * @param array $arr
     * @return mixed
     */
    private function dnsSelect(array $arr){
        return array_rand($arr);
    }

}