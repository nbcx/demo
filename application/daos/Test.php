<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace daos;

use nb\Dao;

/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/4/18 下午2:20
 */
class Test extends Dao {

    public function __construct() {
        parent::__construct('test t','id','dao');
    }

    public function test() {

        $this->find('name=?','张三');

        $this->find('name=? and age>?',['张三',17]);
    }
}