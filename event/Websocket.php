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

use nb\Config;
use nb\Debug;
use nb\Dispatcher;
use nb\event\Swoole;
use nb\Pool;
use utils\PHPMailer;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/12/2 下午4:46
 */
class Websocket extends Swoole {

    public function connect($server, $fd) {
        //foreach ($server->connections as $f) {
        //    $server->push($f, "connection open: {$fd}");
        //}
        echo "connection open: {$fd}\n";
    }


    public function close($server, $fd) {
        //foreach ($server->connections as $f) {
        //    $server->push($f, "connection close: {$fd}");
        //}
        echo "connection close: {$fd}\n";
    }

}