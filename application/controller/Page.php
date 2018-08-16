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

use nb\Controller;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/6/25 上午11:27
 */
class Page extends Controller {

    public function index($page=1) {
        $this->assign('page',$page);
        $this->display('page');
    }
}

