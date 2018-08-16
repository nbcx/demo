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

use utils\Ace;

/**
 * Pool
 *
 * @package controller
 * @link https://nb.cx
 * @since 2.0
 * @author: collin <collin@nb.cx>
 * @date: 2018/8/2
 */
class Pool {

    public function index() {
    }

    //最简单注入
    public function set() {
        $ace = \nb\Pool::set('hello','world');
        ex($ace);

        $ace = \nb\Pool::set('ace',new Ace());
        ex($ace);
    }

    public function rm() {
        $ace = \nb\Pool::rm('ace');
    }

    public function value() {
        /*
        $ace = \nb\Pool::value('ace',function () {
            return new Ace();
        });
        e($ace->name);
        */
        /*
        $name = 'value';
        $ace = \nb\Pool::value('ace',function () use ($name) {
            return new Ace($name);
        });
        e($ace->name);
        */
        $func = function ($name,$age){
            e($age);
            return new Ace($name);
        };
        $name = 'value';
        $age = 12;
        $ace = \nb\Pool::value('ace',$name,$age,$func);
        e($ace->name);
    }

    public function obj() {
        $ace = \nb\Pool::object(\utils\Ace::class);

        $ace = \nb\Pool::object('\utils\Ace');


        $ace = \nb\Pool::object('\utils\Ace',['Ace Name!']);

        $ace = \nb\Pool::object('ace','\utils\Ace',['Ace Name!']);

        $ace = \nb\Pool::object('ace','\utils\Ace');



    }

}