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
 * Date: 2018/7/27 下午11:01
 */
class I18n {

    public function index() {
        ex(\nb\I18n::t('hello'));

        ex(\nb\I18n::t('hello {:name}',['name'=>'Collin']));
    }

    public function load() {
        \nb\I18n::load(__APP__.'lang/zh-cn-2.php');
        ex(\nb\I18n::t('syntax error'));
    }

    public function range() {
        \nb\I18n::load(__APP__.'lang/zh-cn-2.php','test');

        ex(\nb\I18n::t('syntax error'));


        ex(\nb\I18n::tx('test','syntax error'));
    }

    public function vars() {
        \nb\I18n::load(__APP__.'lang/zh-cn-2.php');
        echo \nb\I18n::t('file_format',['format' => 'jpeg,png,gif,jpg','size' => '2MB']);

    }

}