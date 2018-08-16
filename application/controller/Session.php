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
 * Session
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/8/11
 */
class Session {

    public function index($name='index',$value='index') {
        e(\nb\Session::set($name,$value));
    }

    public function flash($name='hello',$value='flash') {
        e(\nb\Session::flash($name,$value));
    }

    public function get($name='hello') {
        e(\nb\Session::get('hello'));
    }

    public function pull($name='hello') {
        e(\nb\Session::pull($name));
    }

}