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

use common\Entity;
use nb\Dao;
use nbtest\Atest;
use nbtest\lib\Btest;
use utils\Ace;
use utils\BitcoinECDSA;
use utils\RSA;

/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/8/9 下午12:08
 */
class Request {

    /**
     * @param $r
     */
    public function get() {
        $get = \nb\Request::input('name','age');
        ex($get);

        list($name,$age) = \nb\Request::input('name','age');
        ex($name);
        ex($age);
    }




}