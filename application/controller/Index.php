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
 * Date: 2018/6/12 上午10:40
 */
class Index extends Controller {


    public function index() {
        echo '<h1>Welcome to use NB Framework!</h1>';
        //ex('Welcome to use NB Framework!');
    }

    public function wel() {
        echo '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> Welcome to use NB Framework!<br/></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div>';
    }

    public function view() {
        $this->assign('hello','NB Framework');
        $this->display('test');
    }



    public function single() {
        $this->display('multi');
    }

}