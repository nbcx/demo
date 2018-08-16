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
 * Date: 17/8/9 下午12:08
 */
class Test {

    public function index(){
       e('console');
    }

    public function nbcx() {
        e('console nbcx');
    }

    public function args($name,$age=12) {
        ex('console args:'.$name.',age:'.$age);
    }

}