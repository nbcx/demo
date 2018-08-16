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

use pml\Body;
use pml\Css;
use pml\css\Text;
use pml\Head;
use pml\Html;
use pml\Script;
use pml\Style;
use pml\Table;
use pml\tag\A;
use pml\tag\H;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/1/16 上午10:14
 */
class Pml {

    public function fmt() {

    }



    public function style() {
        $text = new Text();
        $text->color('red');

        $text2 = new Text();
        $text2->height('300px');

        $css = new Css('.name');
        $css->add($text,$text2);


        $id = new Css('#name');
        $id->add($text,$text2,$css,$css);

        $style = new Style();
        $style->add($text,$text2,$css,$id);
        $style->display();
    }

    public function css() {

        $text = new Text();
        $text->color('red');

        $text2 = new Text();
        $text2->height('300px');

        //$style = new Style();
        //$style->add($text,$text2);
        //$style->display();


        $h3 = new H(3);
        $h3->text('Hello NB Framework');
        $h3->css($text,$text2);
        $h3->display();
    }

    public function html() {

        $blue = new Text();
        $blue->color('blue');

        $css = new Css('.markdown>h3');
        $css->add($blue);

        $style = new Style();
        $style->add($blue,$blue,$css,$css);


        $head = new Head();
        $head->meta('name','description')->attr('content','');
        $head->link('https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css');
        $head->add($style);

        $h1 = new H();
        $h1->text('Hello NB Framework');
        $h1->id('text');

        $h3 = new H(3);
        $h3->text('Hello NB Framework');
        $h3->css($blue);
        //$h3->style('color:red;');


        $table = new Table();
        $table->data([
            ['ddd','hhh','ddd','hhh'],
            ['ddd2','hhh2','ddd','hhh'],
            ['ddd3','hhh3','ddd','hhh'],
            ['ddd','hhh','ddd','hhh'],
            ['ddd2','hhh2','ddd','hhh'],
            ['ddd3','hhh3','ddd','hhh'],
        ]);
        $table->cless('table table-striped');
        $table->cless('table-bordered');

        $body = new Body();
        $body->add($h1,$h3,$table);
        $body->text('I`m Body!');

        $a = new A();
        $a->href('https://nb.cx');
        $a->text('NB Framework');

        $body->add($a,$a);


        $html = new Html();
        $html->lang('zh-CN');
        $html->add($head,$body);

        $html->display();
    }

}