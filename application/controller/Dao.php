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
 * Dao
 *
 * @package controller
 * @link https://nb.cx
 * @author: collin <collin@nb.cx>
 * @date: 2018/9/17
 */
class Dao {

    public function index() {
        $test = new \daos\Test();
        $data = $test->fetchs();
        e($data);
    }

    public function add() {
        $test = new \daos\Test();
        $id = $test->insert([
            'name'=>'张'.rand(10,19),
            'age'=>rand(10,19)
        ]);
        e($id);
    }

    public function transaction() {
        $test = new \daos\Test();
        $test->transaction();

    }

}