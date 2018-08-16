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
 * Date: 2017/12/25 下午5:30
 */
class User {

    public $_method = 'post';

    public function index($id=2) {
        e("ID is {$id}");
    }

}