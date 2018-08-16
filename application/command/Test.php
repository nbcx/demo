<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace command;

use nb\console\Command;
use nb\console\input\Input;
use nb\console\output\Output;
use nb\console\input\Argument;
use nb\console\input\Option;
use nb\console\Pack;

class Test implements Command {

    /**
     *
     */
    public function configure(Pack $cmd) {
        $cmd->setName('test')
            ->addArgument('name', Argument::OPTIONAL, "your name")
            ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            ->setDescription('just test!')
            ->setHelp('default help');
    }

    /**
     * {@inheritdoc}
     */
    public function execute(Input $input, Output $output) {
        $name = trim($input->getArgument('name'))?:'collin';
        if ($input->hasOption('city')) {
            $city = PHP_EOL . 'From ' . $input->getOption('city');
        } else {
            $city = '';
        }
        $output->writeln('My name is '.$name.'!'.$city);
    }

    /**
     * 用户验证
     * @param Input $input
     * @param Output $output
     */
    function interact(Input $input, Output $output){}

    /**
     * 初始化
     * @param Input $input An InputInterface instance
     * @param Output $output An OutputInterface instance
     */
    function initialize(Input $input, Output $output){}

}
