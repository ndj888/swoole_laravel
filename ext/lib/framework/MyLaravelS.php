<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/18
 * Time: 下午10:38
 */

namespace ext\lib\framework;


use ext\service\TcpClientService;
use Hhxsv5\LaravelS\LaravelS;

class MyLaravelS extends LaravelS
{

    public static $tcpClientService;

    public function __construct(array $svrConf, array $laravelConf , TcpClientService $tcpClientService)
    {
        parent::__construct($svrConf, $laravelConf);
        self::$tcpClientService = $tcpClientService;
    }


}