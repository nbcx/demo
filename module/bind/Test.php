<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace module\bind\controller;

use nb\Controller;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/12/22 下午5:43
 */
class Test extends Controller {

    public function index() {
        $this->display('test');
    }

}