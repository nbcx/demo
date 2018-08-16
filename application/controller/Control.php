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
 * Date: 2018/7/24 下午3:07
 */
class Control extends Controller {

    protected $rule = [
        'name'  =>  'require|max:25',
        'age'   => 'number|between:1,120',
        'email' =>  'email',
    ];

    //直接在验证器类中使用message属性定义错误提示信息
    //如果没有定义错误提示信息，则使用系统默认的提示信息
    protected $message  =   [
        'name.require' => '名称必须',
        'name.max'     => '名称最多不能超过25个字符',
        'age.number'   => '年龄必须是数字',
        'age.between'  => '年龄只能在1-120之间',
        'email'        => '邮箱格式错误',
    ];


    public function login() {
        if($this->isGet) {
            $this->display();
        }
        //验证用户名
        list($user,$pass) = $this->input('user','pass');

        $form = $this->form();
        $user = $form['user'];
        $pass = $form['pass'];
    }


    public function login2() {
        if($this->isPost) {

        }
        else {
            $this->display();
        }
    }

    public function view() {
        $this->display();
    }


}