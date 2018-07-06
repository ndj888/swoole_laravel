<?php
/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/4/20 0020
 * Time: 14:31
 */

namespace App\Admin\Extensions;


use Encore\Admin\Form\Field;

class UEditor extends Field
{
    protected static $js = [
        '/laravel-u-editor/ueditor.config.js',
        '/laravel-u-editor/ueditor.all.min.js',
        '/laravel-u-editor/lang/zh-cn/zh-cn.js'
    ];

    protected $view = 'admin.ueditor';

    public function render()
    {
        return parent::render();
    }
}