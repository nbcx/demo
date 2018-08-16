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
 * 模拟主题
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/8/5 下午10:03
 */
class Theme extends Controller {

    public function index() {
        $this->view->config([
            'view_path' =>__APP__ . "theme/default/",
        ]);
        $this->display('index');
    }

    public function simple() {
        $this->view->config([
            'view_path' =>__APP__ . "theme/simple/",
        ]);
        $this->display('index');
    }

}