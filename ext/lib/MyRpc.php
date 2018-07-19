<?php
/**
 * Created by PhpStorm.
 * User: longbob
 * Date: 2018/7/17 0017
 * Time: 11:44
 */

namespace ext\lib;


use com_jjcbs\lib\RPC;

class MyRpc extends RPC
{
    protected $message = [];
    public $checkRules = [];

    public function __construct(array $data = [])
    {
        parent::__construct($data);
        !empty($this->checkRules) && $this->setRules($this->checkRules);
    }

    protected function check()
    {
        // TODO: Implement check() method.
        $vailter = \Validator::make($this->toArray(), $this->getRules(), $this->message);
        $vailter->validate();
    }

}