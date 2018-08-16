<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace component;

use nb\Component;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/8/4 上午9:00
 */
class Udisk extends Component {

    //public static function config() {
    //    return [
    //        'driver'=>'base'
    //    ];
    //}

    public static function read($index=0) {
        return self::driver()->read($index);
    }

    public static function save($data) {
        return self::driver()->save($data);
    }

    public static function del($index) {
        return self::driver()->del($index);
    }
}