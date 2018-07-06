<?php

/**Build by com_jjcbs tool.**/


/**
 * Created by JiangJiaCai.
 * User: Administrator
 * Date: 2017/11/17 0017
 * Time: 10:19
 */

return [
    // the alias map
    'alias' => [
        'Service' => \com_jjcbs\lib\annotation\Service::class,
        'Cache' => \com_jjcbs\lib\annotation\Cache::class
    ],
    // These annotations will be scanning
    'scanNamespace' => [
        "ext\\" => "ext",
        "app\\" => "app"
    ],
    'appPath' => app_path(),
    'buildPath' => app_path(),
    'testConf' => [
        'testDir' => app_path('/tests/cases/'),
        'testNamespace' => 'tests\cases'
    ],
    'tplConf' => [
        //公共模板数据
        'TPL_DATA' => [],
        'TPL_SIGN_START' => '{{',
        'TPL_SIGN_END' => '}}',
        // tpl dir
        'TPL_DIR' => app_path('/ext/resource/tpl/')
    ]
];