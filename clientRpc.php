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
    'ip' => '172.20.1.74',
    'port' => 8868
]));
$config->setPort(8699);
$config->setListen('172.20.1.74');
$config->setServerName("testServer");
$serverRpcImpl = new \ext\lib\RpcClientImpl();
$serverRpcImpl->setRpcClientConfig($config);


echo '开始启动服务';
try{
    $serverRpcImpl->start();
}catch (Exception $e){
    echo $e->getMessage();
}
