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

use nb\Pool;

/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/8/9 下午12:08
 */
class Cli {

    public function index(){
        Pool::destroy();
        ex('console:cli/index');
    }

    public function args($a,$b=12) {
        ex('console:cli/args;args:a='.$a.',b='.$b);
    }

}