<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace validate;

use nb\Validate;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/7/24 上午10:49
 */
class Custom extends Validate {

    protected $rule = [
        'name'  =>  'checkName:nbframework',
        'email' =>  'email',
    ];


    // 自定义验证规则
    protected function checkName($value,$rule,$data=[]) {
        return $rule == $value ? true : '名称必须是nbframework';
    }
}