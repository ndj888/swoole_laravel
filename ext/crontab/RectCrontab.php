<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/8/13 0013
 * Time: 15:51
 */

namespace ext\crontab;


use ext\lib\framework\MyLaravelS;
use Hhxsv5\LaravelS\Swoole\Timer\CronJob;

/**
 * 心跳包定时任务
 * Class RectCrontab
 * @package Crontab
 */
class RectCrontab extends CronJob
{
    public function __construct()
    {
    }

    public function interval()
    {
        // TODO: Implement interval() method.
        return 30000;
    }

    public function isImmediate()
    {
        return true;
    }

    /**
     *
     */
    public function run()
    {
        // TODO: Implement run() method.
        MyLaravelS::$tcpClientService->getRpcClient()->sendRect();
    }

}