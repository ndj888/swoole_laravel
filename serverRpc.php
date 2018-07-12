<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/12 0012
 * Time: 16:28
 */

require 'vendor/autoload.php';
$config = new \ext\bean\RpcServerConfig();
$config->setListen('0.0.0.0');
$config->setPort('8868');
$serverRpcImpl = new \ext\lib\RpcServerImpl();
$serverRpcImpl->setConfig($config);


echo '开始启动服务';
try{
    $serverRpcImpl->serverStart();
}catch (Exception $e){
    echo $e->getMessage();
}
