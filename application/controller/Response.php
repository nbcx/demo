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
 * Response
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2019/4/17
 */
class Response {

    public function index() {
        $resp = \nb\Response::driver();
        //$resp->body(['name'=>'yes'])->send('json');
        $resp->error(500,'you error')->send('json');
    }

}