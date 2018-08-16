<?php
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/6/1 上午9:10
 */
return [

    //自动包含路径
    'path_autoinclude'  => [
        __APP__.\nb\Config::$o->module.DS.'member/include'.DS
    ],

    //自动包含的文件标示,可为数组和字符串
    //数组为host和对应标示的键值对
    'path_autoext'      => [

    ],

    'view' => [
        'view_suffix' => 'html',
        'view_current' => '..'
    ],

    'folder_controller'    =>false,

    'router' => [
        'close'=>false,//是否关闭默认路由，true 是，false 不关闭
        'match'=>[
            'jsp'=>[
                'url'=>'/good.jsp',
                'action'=>'test/jsp'
            ],
            'user2'=>[
                'url'=>'/usr/[id:alpha].htm',
                'action'=>'user/index'
            ],
        ]
    ]
];