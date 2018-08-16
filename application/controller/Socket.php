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
 * 演示swoole的 websocket server 功能
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/8/7
 */
class Socket extends Controller {

    /**
     * websocket前台页面
     */
    public function index() {
        $this->display();
    }

    /**
     * 通过websocket处理http请求
     * 模拟推送
     *
     * @param string $msg
     */
    public function push($msg = 'test') {
        $server = \nb\Server::driver();
        foreach ($server->connections as $fd) {
            $server->push($fd, $msg);
        }
    }

    /**
     * 需要通过websocket访问
     */
    public function group($data) {
        $server = \nb\Server::driver();
        $frame = \nb\Pool::get('\swoole\websocket\Frame');
        foreach ($server->connections as $fd) {
            if($server->exist($fd)) {
                $server->push($fd, '['.$frame->fd.'][group]['.date('m-d H:i:s').']:'.$data);
            }
        }
    }

    /**
     * 请通过websocket访问
     */
    public function personal($data) {
        echo '[personal]['.date('m-d H:i:s').']:'.$data;
    }
}