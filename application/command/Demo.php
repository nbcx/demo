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
use nb\console\output\Ask;
use nb\console\output\Formatter;
use nb\console\output\Output;
use nb\console\input\Argument;
use nb\console\input\Option;
use nb\console\output\ProgressBar;
use nb\console\output\Question;
use nb\console\output\question\Choice;
use nb\console\output\question\Confirmation;
use nb\console\output\Table;
use nb\console\output\table\Cell;
use nb\console\output\table\Separator;
use nb\console\output\table\Style;
use nb\console\Pack;

class Demo implements Command {

    private $pack;

    public function configure(Pack $cmd) {

        $cmd->setName('demo');
        $cmd->addArgument('name', Argument::REQUIRED, '你想打招呼的人?');
        $cmd->addArgument('last_name', Argument::OPTIONAL, '你的名字呢?');
        $cmd->addArgument(
            'names',
            Argument::IS_ARRAY,
            '你想问候谁（用空格分隔多个名字）?'
        );
        $cmd->addOption(
            'iterations',
            null,
            Option::VALUE_REQUIRED,
            'How many times should the message be printed?',
            1
        );
    }

    public function execute(Input $input, Output $output) {

        $text = 'Hi '.$input->getArgument('name');

        $names = $input->getArgument('names');
        if (count($names) > 0) {
            $text .= ' '.implode(', ', $names);
        }
        $lastName = $input->getArgument('last_name');
        if ($lastName) {
            $text .= ',I`m '.$lastName;
        }

        for ($i = 0; $i < $input->getOption('iterations'); $i++) {
            $output->writeln($text.'!');
        }
    }

    public function configure_bak(Pack $cmd) {
        $cmd->setName('demo')
            ->addArgument('name', Argument::OPTIONAL, "your name")
            ->addOption('city', null, Option::VALUE_REQUIRED, 'city name')
            ->setDescription('just test!')
            ->setHelp('default help');

        $this->pack = $cmd;
    }


    /**
     * {@inheritdoc}
     */
    public function execute_bac(Input $input, Output $output) {
        $output->question('hello');
        $output->writeln('<bg=yellow;options=bold>foo</>');
        return;
        /** @var Formatter $formatter */
        $formatter = $output->getFormatter();
        $style = new \nb\console\output\formatter\Style('red', 'yellow', ['bold', 'blink']);
        $formatter->setStyle('fire', $style);

        $output->writeln('<fire>foo</fire>');
        return;

        $name = trim($input->getArgument('name'))?:'collin';
        switch ($name) {
            case 'ask':
                $this->ask($input,$output);
                break;
            case 'choice':
                $this->choice($input,$output);
                break;
            case 'multi':
                $this->multi($input,$output);
                break;
            case 'hidden':
                $this->hidden($input,$output);
                break;
            case 'confirm':
                $this->confirm($input,$output);
                break;
            case 'autocomplete':
                $this->autocomplete($input,$output);
                break;
            case 'validator':
                $this->validator($input,$output);
                break;
            case 'progress':
                $this->progress($output);
                break;
            case 'table':
                $this->table($output);
                break;
            default:
                $output->describe($this->pack);
                break;
        }

    }

    //隐藏用户响应
    private function hidden(Input $input, Output $output) {
        $question = new Question('请输入你的密码?');
        $question->setHidden(true);
        $question->setHiddenFallback(false);

        $ask = new Ask($input, $output, $question);
        $pass = $ask->run();
        $output->writeln($pass);
    }

    //要求用户确认
    private function confirm(Input $input, Output $output) {
        //$confirm = $output->confirm($input,'yours confirm?',false);
        //$output->writeln($confirm);

        $confirm = new Confirmation('继续执行吗?', false);

        $ask = new Ask($input, $output, $confirm);
        $answer = $ask->run();
        if($answer) {
            $output->writeln('你选择了继续执行');
        }
        else {
            $output->writeln('你选择了停止执行');
        }
    }

    //询问用户信息
    private function ask(Input $input, Output $output) {
        $question = new Question('请输入你的名字?','张三');

        $ask = new Ask($input, $output, $question);
        $answer = $ask->run();
        $output->writeln('你好！'.$answer);
    }

    //让用户从答案列表中选择
    private function choice(Input $input, Output $output) {
        $choice = new Choice('请选择你的性别?', ['男','女'], 1);
        $choice->setErrorMessage('你输入了一个无效的选择！');
        $ask = new Ask($input, $output, $choice);
        $answer = $ask->run();
        $output->writeln('你是一个'.$answer.'人');
    }

    //多选
    private function multi(Input $input, Output $output) {
        $choice = new Choice('请选择你喜欢的颜色?', ['red', 'blue', 'yellow'], '0,1');
        $choice->setErrorMessage('你输入了一个无效的选择！');
        $choice->setMultiselect(true);

        $ask = new Ask($input, $output, $choice);
        $answer = $ask->run();
        $output->writeln('你选择了: ' . implode(', ', $answer));
    }

    //自动完成
    private function autocomplete(Input $input, Output $output) {
        $word = ['AcmeDemoBundle', 'AcmeBlogBundle', 'AcmeStoreBundle'];
        $question = new Question('请输入一个单词？', 'FooBundle');
        $question->setAutocompleterValues($word);

        $ask = new Ask($input, $output, $question);
        $answer = $ask->run();
        $output->writeln($answer);
    }

    private function validator(Input $input, Output $output) {
        $question = new Question('Please enter the name of the bundle', 'AcmeDemoBundle');
        $question->setValidator(function ($answer) {
            if ('Bundle' !== substr($answer, -6)) {
                throw new \RuntimeException(
                    'The name of the bundle should be suffixed with \'Bundle\''
                );
            }
            return $answer;
        });
        //允许的错误次数
        $question->setMaxAttempts(2);

        $ask = new Ask($input, $output, $question);
        $answer = $ask->run();
        $output->writeln($answer);
    }

    private function hiddenValidator(Input $input, Output $output) {
        $question = new Question('Please enter the name of the bundle', 'AcmeDemoBundle');
        $question->setValidator(function ($answer) {
            if ('Bundle' !== substr($answer, -6)) {
                throw new \RuntimeException(
                    'The name of the bundle should be suffixed with \'Bundle\''
                );
            }
            return $answer;
        });
        //允许的错误次数
        $question->setMaxAttempts(2);

        $answer = $output->ask($input,$question);
        $output->writeln($answer);
    }

    private function progress(Output $output) {
        // create a new progress bar (50 units)
        // 创建一个新的进度条（50单元）
        $progress = new ProgressBar($output,30);//, 50

        // start and displays the progress bar
        // 启动并显示进度条
        $progress->start();

        $i = 0;
        while ($i++ < 50) {
            // ... do some work / 做一些事
            sleep(1);
            // advance the progress bar 1 unit
            // 推进进度条一个单位
            $progress->advance();

            // you can also advance the progress bar by more than 1 unit
            // 你也可以用一个以上的单位来推进进度条
            // $progress->advance(3);
        }

        // ensure that the progress bar is at 100%
        // 确保进度条达到100%
        $progress->finish();
        $output->writeln('end ...');
    }

    private function table(Output $output) {

        $table = new Table($output);
        $table->setHeaders(['ISBN', '书名', '作者'])
            ->setRows([
                [
                    '978-0521567817',
                    'De Monarchia',
                    new Cell("Dante Alighieri\nspans multiple rows", ['rowspan' => 2]),
                ],
                ['978-0804169127', 'Divine Comedy'],
            ])
        ;

        $table->render();
        return;


        $table->setHeaders(['ISBN', '书名', '作者'])
            ->setRows([
                ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
                new Separator(),
                [new Cell('This value spans 3 columns.', ['colspan' => 3])],
            ])
        ;
        $table->render();
        return;
        $table->setHeaders(array(
            array(new Cell('Main table title', array('colspan' => 3))),
            array('ISBN', 'Title', 'Author'),
        ));
        $table->render();
        return;




        $table->setHeaders(['ISBN', '书名', '作者'])
          ->setRows([
              ['99921-58-10-7', 'Divine Comedy', 'Dante Alighieri'],
              ['9971-5-0210-0', 'A Tale of Two Cities', 'Charles Dickens'],
              //new Separator(),
              ['960-425-059-0', 'The Lord of the Rings', 'J. R. R. Tolkien'],
              ['80-902734-1-6', 'And Then There Were None', 'Agatha Christie'],
          ]);
        $style = new Style();
        $style
            ->setHorizontalBorderChar('<fg=magenta>|</>')
            ->setVerticalBorderChar('<fg=magenta>-</>')
            ->setCrossingChar(' ')
        ;

        // use the style for this table
        $table->setStyle($style);
        //$table->setStyle('borderless');
        //$table->setColumnWidths([10, 0, 30]);
        $table->render();
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
