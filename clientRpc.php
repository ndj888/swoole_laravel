<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/12 0012
 * Time: 16:28
 */

require 'vendor/autoload.php';
$config = new \ext\bean\RpcClientConfig();
$config->setServerAddress(new \ext\bean\Ipv4Address([
    'ip' => '172.24.156.97',
    'port' => 8868
]));
$serverRpcImpl = new \ext\lib\RpcClientImpl();
$serverRpcImpl->setRpcClientConfig($config);


echo '开始启动服务';
try{
    $serverRpcImpl->start();
}catch (Exception $e){
    echo $e->getMessage();
}
