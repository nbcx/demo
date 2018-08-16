<?php
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/7/12 下午12:44
 */
namespace utils;

use nb\Access;

class Ace extends Access {

    public function __construct($name=null) {
        echo 'Ace __construct';
        $this->name = $name?:'ace';
    }

}