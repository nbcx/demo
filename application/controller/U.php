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

use component\Udisk;

/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/8/4 上午11:00
 */
class U {

    public function index() {
        Udisk::save('hello');

        echo Udisk::read();
    }

}