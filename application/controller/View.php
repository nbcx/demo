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
 * Date: 2017/12/27 上午8:56
 */
class View {

    /**
     * 最简单的视图输出
     */
    public function index() {
        $view = \nb\View::ins();
        $view->assign('hello','NB Framework');
        $view->display('template/index');
    }

    public function module() {
        \nb\View::ins()->display('member@index');
    }

    public function parse() {
        $content = '{$name}-{$email}';

        $view = \nb\View::ins();
        $view->assign(['name' => 'nb', 'email' => 'admin@nb.cx']);
        $resutl = $view->show($content);
        echo $resutl;
    }

    /**
     * 使用PHP模版输出
     */
    public function php() {
        $hello = 'NB Framework';
        include view('test');
    }

    /**
     * 使用标签模版输出
     */
    public function template() {
        $hello = 'NB Framework';

        $view = \nb\View::ins();
        $view->assign('hello',$hello);
        $view->display('template/index');
        $view->show('template/index');
        $view->show();
    }

    /**
     * 使用快捷标签模版函数输出
     */
    public function template2() {
        $hello = 'NB Framework';
        template('template',[
            'hello'=>$hello
        ]);
    }

}