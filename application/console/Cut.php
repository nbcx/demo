<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace console;

use utils\Files;
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 2018/6/1 上午11:01
 */
class Cut {

    public function index() {
        $files = new Files();
        for($i=16;$i<47;$i++) {
            $source = glob("/home/www/16-46/{$i}/*");
            e($source);

            //裁剪
            $specs = $files->makeSpec(
                3000,
                2000,
                $source,
                "/home/www/new-16-46/{$i}/"
            );
            e($specs);
        }

        //添加水印
        /*
        $specs = $files->imgwatermark(
            $specs,
            $config['watersrc'],
            $config['alpha']
        );
        */
    }



}