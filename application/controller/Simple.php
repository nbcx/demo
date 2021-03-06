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
 * Date: 2018/7/24 下午3:12
 */
class Simple {

    public $_rule = [
        'name'  =>  'require|max:25',
        'age'   => 'number|between:1,120',
        'email' =>  'email',
    ];

    //直接在验证器类中使用message属性定义错误提示信息
    //如果没有定义错误提示信息，则使用系统默认的提示信息
    public $_message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',
    ];

    /**
     * 验证失败的回调函数
     * 如果省略此函数，框架自动使用内置的错误回调处理
     *
     * @param $error 错误信息
     * @param $filed 错误字段
     */
    public function __error($error,$filed) {
        e($error,$filed);
    }

    public function index($name=null) {
        e($name);
    }

}