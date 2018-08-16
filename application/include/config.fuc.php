<?php

/**
 * 将markdown转为html
 * @param $text
 * @return mixed
 */
function markdown($text) {
    $parser = \nb\Pool::value('\module\doc\HyperDown',function (){
        $parser = new \module\doc\HyperDown();
        //$parser->hook('afterParseCode', ['Markdown', 'transerCodeClass']);
        ///$parser->hook('beforeParseInline', ['Markdown', 'transerComment']);

        $parser->enableHtml(true);
        $parser->_commonWhiteList .= '|img|cite|embed|iframe';
        $parser->_specialWhiteList = array_merge($parser->_specialWhiteList, [
            'ol' => 'ol|li',
            'ul' => 'ul|li',
            'blockquote' => 'blockquote',
            'pre' => 'pre|code'
        ]);
        return $parser;
    });
    return $parser->makeHtml($text);
}




