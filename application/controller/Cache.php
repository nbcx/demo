<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace controller;

use nb\Controller;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/1/10 下午7:38
 */
class Cache extends Controller {

    public function index() {
        $this->display();
    }

    public function start() {

        echo 'success';

        //后台运行
        ignore_user_abort(true);
        //取消脚本运行时间的超时上限
        set_time_limit(0);
        //让浏览器回到前一页
        //使用的是FastCGI模式，用下面方法能马上结束会话
        fastcgi_finish_request();

        \nb\Cache::rm('start');
        $sign = true;
        while ($sign) {
            sleep(3);
            $start = \nb\Cache::getx('start',function (){
                return 1;
            });
            $start = $start+5;
            if($start>100) {
                \nb\Cache::set('start',100);
                $sign = false;
                die();
            }
            \nb\Cache::set('start',$start);
        }

    }

    public function status() {
        $start = \nb\Cache::getx('start',function (){
            return 1;
        });
        echo $start;
    }

}