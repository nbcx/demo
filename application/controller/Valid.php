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
 * Date: 2017/12/25 下午5:30
 */
class Valid {

    public function index() {
        $data = [
            'name'  => 'nb framework',
            'email' => 'admin@nb.cx'
        ];

        $validate = new \validate\User();

        if ($validate->check($data)) {
            ex('验证成功');
        }
        else {
            ex($validate->error);
        }
    }

    public function batch() {
        $data = [
            'name'  => 'nb framework',
            'email' => 'admin@nb.cx',
        ];

        $validate = new \validate\User();
        //开启批量验证
        $validate->batch(true);
        if ($validate->check($data)) {
            ex('验证成功');
        }
        else {
            ex($validate->error);
        }
    }

    public function custom() {
        $data = [
            'name'  => 'nb framework',
            'email' => 'admin@nb.cx'
        ];

        $validate = new \validate\Custom();

        if ($validate->check($data)) {
            ex('验证成功');
        }
        else {
            ex($validate->error);
        }
    }

    public function func() {
        $validate = new \nb\Validate;
        $validate->rule('age|年龄', 'number|between:1,120')
        ->rule([
            'name'  => 'require|max:25',
            'email' => 'email'
        ]);

        $data = [
            'name'  =>  'checkName:thinkphp',
            'age'=>121,
            'email' =>  'email',
        ];

        if (!$validate->check($data)) {
            ex($validate->error);
        }
    }

    public function func2() {
        $validate = new \nb\Validate;
        $validate->rule([
            'name'  => function($value) {
                return 'nbframework' == strtolower($value) ? true : '用户名错误';
            },
        ]);

        $data = [
            'name'  => 'nb framework',
            'email' => 'admin@nb.cx'
        ];

        if ($validate->check($data)) {
            ex('验证成功');
        }
        else {
            ex($validate->error);
        }
    }

    public function message() {
        $data = [
            'name'  => 'nbframework',
            'email' => 'admin@nb.cx.'
        ];

        $validate = new \validate\Custom();
        $validate->message('name.require','名称必须');
        $validate->message([
            'name.require' => '名称是必须的',
            'name.max'     => '名称最多不能超过25个字符',
            'email'        => '邮箱格式有错误哦',
        ]);
        if ($validate->check($data)) {
            ex('验证成功');
        }
        else {
            ex($validate->error);
        }
    }

    public function scene() {
        $data = [
            'name'  => 'thinkphp',
            'age'   => 1011,
            'email' => 'thinkphp@qq.com.',
        ];
        $validate = new \validate\User();;
        $validate->scene('edit');
        if ($validate->check($data)) {
            ex('验证成功');
        }
        else {
            ex($validate->error);
        }
    }

}