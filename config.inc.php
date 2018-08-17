<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
/**
 * 系统框架配置
 */
return [
    //是否开启调试
    'debug'=>true,

    'default_index'       => 'index/index',

    //注册模块
    'module_register' => [
        'member'
    ],

    //给模块配置独立使用域名
    'module_bind' => [
        'bind.ol.cx'=>'bind',
        'member.ol.cx'=>'member'
    ],

    //测试组件配置
    'udisk' => [
        'driver'=>'base'
    ],

    'dao' => [
        'driver'	=> 'mysql',
        'host' 		=> 'localhost',
        'port' 		=> '3306',
        'dbname'    => 'nmember',
        'user' 		=> 'root',
        'pass' 		=> '123456',
        'connect'   => 'false',
        'charset' 	=> 'UTF8',
        'prefix'    => 'nb_', // 数据库表前缀
    ],

    'i18n' => [
        'path'=> __APP__.'lang/zh-cn.php'
    ]
];

