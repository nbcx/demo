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
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/12/8 上午10:09
 */
class Task {

    public function index($data='hello') {
        //$result = Server::$o->server->task($data);
        //e($result);

        $task = new \nb\utility\Task();
        $task->action('mails');
        $task->args(['ai'=>'good']);
        $result = $task->exec();
        e($result);
    }

}