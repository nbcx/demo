<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace task;

/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/12/8 上午11:11
 */
class Test {

    public function index($param,\swoole\Server $serv, $task_id, $src_worker_id) {
        l('Test--$task_id:'.$task_id);
        l('Test--$src_worker_id:'.$src_worker_id);
        l($param);
    }

}