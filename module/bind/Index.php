<?php
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2017/12/26 下午6:05
 */
namespace module\bind\controller;

use nb\Controller;

class Index extends Controller {

    /**
     * url:bind.xxx.com/main/index
     */
    public function index() {
        e('Bind Index index');
    }

    /**
     * url:bind.xxx.com/main/test
     */
    public function test(){
        e('Bind Main test');
    }

}