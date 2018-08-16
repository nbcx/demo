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
use nb\Debug;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/8/9 下午12:08
 */
class Test {

    /**
     * 访问地址：http://demo.ol.cx/test/index
     * 控制器的默认访问函数就是index，因此下面的访问也是同样的
     * http://demo.ol.cx/test
     */
    public function index(){
        ex('Hello NB');
    }

    /**
     * 访问地址：http://demo.ol.cx/test/nbcx
     */
    public function nbcx() {
        ex('Hello NBCX');
        Debug::breakd('name','value');
    }


}