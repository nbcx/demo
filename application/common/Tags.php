<?php
/*
 * This file is part of the NB Framework package.
 *
 * Copyright (c) 2018 https://nb.cx All rights reserved.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace common;

use nb\view\tag\Driver;

class Tags extends Driver {

    /**
     * 定义标签列表
     */
    protected $tags = [
        //前台模板标签
        'template' => ['attr' => 'file,theme', 'close' => 0],

        //工具标签
        'close'     => ['attr' => 'time,format', 'close' => 0], //闭合标签，默认为不闭合
        'while'     => ['attr' => 'type', 'close' => 1],
        'volist'    => ['attr' => 'name,id,offset,length,key,mod', 'alias' => 'iterate'],
        'tree'      => ['attr' => 'name,wrapTag,wrapClass,firstClass,itemTag,itemClass,childName,hrefName,showName', 'close' => 0],
        'have'      => ['attr' => 'type', 'close' => 1],

        //业务标签
        'post'      => ['attr' => 'name,type', 'close' => 1],
        'tags'      => ['attr' => 'name,type', 'close' => 1],
        'comment'   => ['attr' => 'name,type', 'close' => 1],
        'navigate'  => ['attr' => 'name,type', 'close' => 1],
        'page'      => ['attr' => 'name,have', 'close' => 1],
        'doc'       => ['attr' => 'name,have', 'close' => 1],
        'chapter'   => ['attr' => 'name,action,where,output', 'close' => 1],
    ];

    /**
     * empty标签解析
     * 如果某个变量为empty 则输出内容
     * 格式： {empty name="" }content{/empty}
     * @access public
     * @param array $tag 标签属性
     * @param string $content 标签内容
     * @return string
     */
    public function tagHave($tag, $content) {
        $name = $tag['name'];
        $name = $this->autoBuildVar($name);
        $parseStr = "<?php if({$name} && (({$name} instanceof util\Widget && {$name}->have()) || is_array({$name}))): ?>". $content . '<?php endif; ?>';
        return $parseStr;
    }

    /**
     * 文档
     */
    public function tagDoc($tag, $content) {
        $name  = isset($tag['name']) ? $tag['name'] : false;
        $action   = isset($tag['action']) ? $tag['action'] : 'list';
        $where   = isset($tag['where']) ? $tag['where'] : false;
        $output = isset($tag['output']) ? $tag['output'] : 'obj';
        if($action=='list') {
            $obj = 'util\Widget::widget("logic\document\Admin");';
        }
        else if($action=='id') {
            $obj = 'util\Widget::widget("logic\document\Admin");';
        }
        else {
            return '';
        }
        $parse = '<?php  $'.$name.' = '.$obj.' ?>';
        $parse .= $content;
        return $parse;
    }

    /**
     * 文档章节
     */
    public function tagChapter($tag, $content) {
        $name  = isset($tag['name']) ? $tag['name'] : false;
        $action   = isset($tag['action']) ? $tag['action'] : 'list';
        $where   = isset($tag['where']) ? $tag['where'] : false;
        $output = isset($tag['output']) ? $tag['output'] : false;
        if($action=='list') {
            $obj = 'util\Widget::widget("logic\document\chapter\Lists");';
        }
        else if($action=='id') {
            $obj = 'util\Widget::widget("logic\document\chapter\Detail");';
        }
        else {
            return '';
        }
        $parse = '<?php  $'.$name.' = '.$obj.' ?>';
        $parse .= $content;
        return $parse;
    }

    /**
     * 树
     */
    public function tagTree($tag, $content) {
        $data = $tag['name'];
        $wrapTag = empty($tag['wrapTag'])?'ul':$tag['data'];
        $wrapClass = empty($tag['wrapClass'])?'':$tag['wrapClass'];
        $firstClass = empty($tag['firstClass'])?'':$tag['firstClass'];
        $itemTag = empty($tag['itemTag'])?'li':$tag['itemTag'];
        $itemClass = empty($tag['itemClass'])?'':$tag['itemClass'];
        $childName = empty($tag['childName'])?'children':$tag['childName'];
        $hrefName = empty($tag['hrefName'])?'permalink':$tag['hrefName'];
        $showName = empty($tag['showName'])?'title':$tag['showName'];

        //viewTree($data,$wrapTag='ul',$wrapClass='',$firstClass='',$itemTag='li',$itemClass='',$childName='children',$hrefName='permalink',$showName='title')
        $parse = '<?php ';
        $parse .= "viewTree($data,'{$wrapTag}','{$wrapClass}','{$firstClass}','{$itemTag}','{$itemClass}','{$childName}','{$hrefName}','{$showName}');";
        $parse .= ' ?>';
        return $parse;
    }

    /**
     * 文章标签
     */
    public function tagPost($tag, $content) {
        $obj = 'util\Widget::widget("logic\post\Admin");'; // 这里是模拟数据
        $parse = $this->_content($obj,$tag, $content);
        return $parse;
    }

    /**
     * 单页标签
     */
    public function tagPage($tag, $content) {
        $obj = 'util\Widget::widget("logic\page\Lists");'; // 这里是模拟数据
        $parse = $this->_content($obj,$tag, $content);
        return $parse;
    }

    /**
     * 这是一个非闭合标签的简单演示
     */
    public function tagWhile($tag, $content) {
        $empty = isset($tag['empty']) ? $tag['empty'] : '';
        $name = isset($tag['name']) ? $tag['name'] : 'list';
        $key = !empty($tag['key']) ? $tag['key'] : 'i';
        $parse = '<?php ';
        $flag = substr($name, 0, 1);
        if (':' == $flag) {
            $name = $this->autoBuildVar($name);
            $parse .= '$_result=' . $name . ';';
            $name = '$_result';
        }
        else {
            $name = $this->autoBuildVar($name);
        }

        $parse .= 'if(' . $name . ' instanceof \util\Widget && '.$name.'->have()): ';
        $parse .= '$'.$key.'=0;';
        $parse .= 'while('. $name .'->next()):';
        $parse .= '$'.$key.'++;';
        $parse .= ' ?>';
        $parse .= $content;
        $parse .= '<?php endwhile; else: echo "' . $empty . '" ;endif; ?>';

        return $parse;
    }

    /**
     * 这是一个闭合标签的简单演示
     */
    public function tagClose($tag) {
        $format = empty($tag['format']) ? 'Y-m-d H:i:s' : $tag['format'];
        $time = empty($tag['time']) ? time() : $tag['time'];
        $parse = '<?php ';
        $parse .= 'echo date("' . $format . '",' . $time . ');';
        $parse .= ' ?>';
        return $parse;
    }

    /**
     * 文章标签
     */
    public function tagComment($tag, $content) {
        $type = empty($tag['type']) ? 0 : 1; // 这个type目的是为了区分类型，一般来源是数据库
        $name = $tag['name']; // name是必填项，这里不做判断了
        $parse = '<?php ';
        $parse .= '$posts = util\Widget::widget("logic\post\Admin");'; // 这里是模拟数据
        $parse .= 'if($posts->have()):';
        $parse .= 'while($posts->next()):';
        $parse .= ' ?>';
        $parse .= $content;
        $parse .= '<?php ';
        $parse .= 'endwhile;';
        $parse .= 'endif;';
        $parse .= ' ?>';
        return $parse;
    }


    /**
     * 模板包含标签
     * 格式：<admintemplate file="模块/控制器/模板名"/>
     * @param type $attr 属性字符串
     * @param type $content 标签内容
     * @return string 标签解析后的内容
     */
    public function tagTemplate($attr, $content) {
        $file = explode("/", $attr['file']);

        $module = NConfig::getx('module');
        $alias = NConfig::getx('app_alias');
        if($file[0] == $alias) {
            $file_path = str_replace($file[0],"application/view",$attr['file']);
        }
        if(in_array($file[0],$module)) {
            $file_path = str_replace($file[0],"module/$file[0]/view",$attr['file']);
        }

        //模板路径
        $path = __APP__ . $file_path . '.php';

        //判断模板是否存在
        if (is_file($path)) {
            //读取内容
            $parseStr = file_get_contents($path);
            //解析模板内容
            $this->tpl->parse($parseStr);
            return $parseStr;//$parseStr;
        }
        return '';
    }

    /**
     * 文章标签
     */
    public function _content($obj,$tag, $content) {
        $empty = isset($tag['empty']) ? $tag['empty'] : false;
        $name = isset($tag['name']) ? $tag['name'] : 'list';
        $have = isset($tag['have']) ? $tag['have'] : false;
        $parse = '<?php ';
        $parse .= '$'.$name.' = '.$obj; // 这里是模拟数据
        $parse .= 'if($' . $name . '->have()): ';
        if($have) {
            $parse .= '$' . $have . '=true;';
        }
        $parse .= $this->_while($name,$tag,$content);
        $parse .= 'else:';
        if($empty) {
            $parse .= 'echo "' . $empty . '" ;';
        }
        $parse .= 'endif;';
        $parse .= ' ?>';
        return $parse;
    }

    /**
     * 这是一个非闭合标签的简单演示
     */
    public function _while($name,$tag, $content) {
        $key = !empty($tag['key']) ? $tag['key'] : 'i';
        $parse = '$'.$key.'=0;';
        $parse .= 'while($'. $name .'->next()):';
        $parse .= '$'.$key.'++;';
        $parse .= ' ?>';
        $parse .= $content;
        $parse .= '<?php ';
        $parse .= 'endwhile; ';

        return $parse;
    }

    /**
     * 获取评论归档对象
     *
     * @access public
     * @return Widget_Abstract_Comments
     */
    public function comments() {
        $parameter = [
            'parentId' => $this->hidden ? 0 : $this->cid,
            'parentContent' => $this->row,
            'respondId' => $this->respondId,
            'commentPage' => $this->request->filter('int')->commentPage,
            'allowComment' => $this->allow('comment')
        ];

        return $this->widget('logic\comment\Archive', $parameter);
    }
}

