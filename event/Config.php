<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace event;
/**
 * 系统框架配置
 */
class Config extends \nb\Config {

    public $namespace    = [
        'pml'=>'/home/www/pml'
    ];

    /**
     * 注入一个类，来自定义框架里的一些事件，如报错处理，
     * @var string
     */
    public $register            = 'event\\Framework';

    //模版引擎配置
    public $view = [
        'tpl_replace_string' => [
            '_pub_' =>'/style/',
            '_static_' =>'/style/',
            '_url_'   =>'/',
            '_themes_'=>'/style/'
        ],
        'tpl_cache' => true,
    ];

    public $router = [
        'default'=>false,//是否关闭默认路由，true 是，false 不关闭
        'match'=>[
            'router'=>[
                'url'=>'/',
                'action'=>'index'
            ],
        ]
    ];

    //Session设置
    public $session = [
        'driver'=>'',
        'id'             => '',
        'var_session_id' => '',// SESSION_ID的提交变量,解决flash上传跨域
        'prefix'         => 'nb_',// SESSION 前缀
        'type'           => 'native',// 驱动方式 支持redis memcache memcached
        'auto_start'     => true,// 是否自动开启 SESSION

        // redis主机
        'host'       => '127.0.0.1',
        // redis端口
        'port'       => 6379,
        // 密码
        'password'   => '',
    ];

    public $server_php = [
        'driver'=>'php',
        'host'=>'127.0.0.1',
        'port'=>8000,
        'root'=> __APP__ . 'public'
    ];

    //swoole配置
    public $server_http = [
        'driver'=>'http',
        'register'=>'common\\Server',//注册一个类，来实现swoole自定义事件
        'host'=>'0.0.0.0',
        'port'=>9501,
        'max_request'=>100,//worker进程的最大任务数
        'worker_num'=>2,//设置启动的worker进程数。
        'dispatch_mode'=>2,//据包分发策略,默认为2
        'debug_mode'=>3,
        'enable_gzip'=>0,//是否启用压缩，0为不启用，1-9为压缩等级
        'log_file'=>__APP__.'tmp'.DS.'swoole-http.log',
        'enable_pid'=>'/tmp/swoole.pid',
        'daemonize'=>false,

        //异步任务处理配置
        'task_worker_num'=>2,

    ];

    public $server_tcp = [
        'driver'=>'tcp',
        'register'=>'event\\Server',//注册一个类，来实现swoole自定义事件
        'host'=>'0.0.0.0',
        'port'=>9502,
        'max_request'=>100,//worker进程的最大任务数
        'worker_num'=>2,//设置启动的worker进程数。
        'dispatch_mode'=>2,//据包分发策略,默认为2
        'debug_mode'=>3,
        'enable_gzip'=>0,//是否启用压缩，0为不启用，1-9为压缩等级
        'log_file'=>__APP__.'tmp'.DS.'swoole-tcp.log',
        'enable_pid'=>'/tmp/swoole.pid',
        'daemonize'=>false,
        //异步任务处理配置
        'task_worker_num'=>2,
    ];

    public $server = [
        'driver'=>'Websocket',
        'register'=>'event\\Websocket',//注册一个类，来实现swoole自定义事件
        'host'=>'0.0.0.0',
        'port'=>9503,
        'max_request'=>100,//worker进程的最大任务数
        'worker_num'=>2,//设置启动的worker进程数。
        'dispatch_mode'=>2,//据包分发策略,默认为2
        'debug_mode'=>3,
        'enable_gzip'=>0,//是否启用压缩，0为不启用，1-9为压缩等级
        'log_file'=>__APP__.'tmp'.DS.'swoole-socket.log',
        'enable_pid'=>'/tmp/swoole.pid',
        'daemonize'=>false,
        //异步任务处理配置
        'task_worker_num'=>2,
        'request'=>true,//启用内置的onRequest回调
    ];

    //SwooleHttpServer模式下，可添加此配置处理资源文件请求
    public  $dispatcher = [
        'enable'=>true,//是否开启资源文件请求处理
        'path'=>__APP__,//资源文件根目录
        'allow'=>'ico|css|js|jpg|png',//允许处理的资源文件后戳
        'expire'=>1800,//浏览器过期时间
    ];


    //文件缓存配置
    public $cache            = [
        //'driver'    => 'File',
        'timeout'   => 86400,
        'ext'       => '.cache',
    ];

    public $console = [
        'name'    => 'Demo Console',
        'version' => '1.0',
        'user'    => null,
        'commands'=>[
            'command\\Test',
            'command\\Demo',
            'command\\Client'
        ]
    ];

}

