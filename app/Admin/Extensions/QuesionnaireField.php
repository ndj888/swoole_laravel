<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/7/15 0015
 * Time: 23:40
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;
use ext\lib\ServiceFactory;
use ext\service\QuesionnaireServiceImpl;

class QuesionnaireField extends Field
{
    private $quserionnaireServiceImpl;

    public function __construct($column, array $arguments = [])
    {
        parent::__construct($column, $arguments);
        $this->quserionnaireServiceImpl = ServiceFactory::getInstance(QuesionnaireServiceImpl::class);
    }

    public function render()
    {
        $data = $this->variables();
        $arr = $this->value ?? [
                'radio' => [],
                'text' => [],
                'multiple' => []
            ];
        if (!empty($arr)) {
            foreach ($arr as $v) {
                if (empty($v)) continue;
                $arr[$v->getType()] = $v->getContent();
            }
        }
        $data['value'] = $arr;
//        var_dump($data['value']['multiple']);
//        die;
        return view($this->getView(), $data);
    }

    public function fill($data)
    {
        parent::fill($data); // TODO: Change the autogenerated stub
        $this->value = unserialize($this->value);
    }

    public function prepare($data){
        return $this->quserionnaireServiceImpl->getStrData($data);
    }
}