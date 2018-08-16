<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace component\udisk;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/8/4 上午10:06
 */
abstract class Driver {

    private $data = [];

    abstract public function volume();

    public function read($index=0) {
        if(isset($this->data[$index])) {
            return $this->data[$index];
        }
    }

    public function save($data) {
        if(count($data) < $this->volume()) {
            $this->data[] = $data;
        }
    }

    public function del($index) {
        if(isset($this->data[$index])) {
            unset($this->data[$index]);
        }
    }
}
