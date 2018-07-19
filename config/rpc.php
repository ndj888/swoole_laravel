<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/18 0018
 * Time: 17:20
 */

return [
    'clientListen' => env('RPC_CLIENT_IP'),
    'clientPort' => env('RPC_CLIENT_PORT'),
    'serverListen' => env('RPC_SERVER_IP'),
    'serverPort' => env('RPC_SERVER_PORT'),
    'tcpUpTime' => env('RPC_TCP_UP_TIME' , 30),
];