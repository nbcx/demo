<?php
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 17/6/28 上午9:38
 */

namespace common;

use daos\DomainDao;
use daos\WebsiteDao;
use nb\Cache;
use nb\Config;
use nb\Dao;

class Configure extends Config {

    //用户相对目录
    public $usr_relative_dir      = '';

    //用户根目录
    public $usr_root_dir          = '';

    //用户完整目录
    public $usr_dir               = __APP__.'usr'.DS;

    //定义用户目录URL
    public $usr_url               = __URL__.'usr/';

    protected function onInit(Config $cfg) {
        $result = Cache::getx($_SERVER['HTTP_HOST'],0,function(){
            //获取站点ID
            $domainDao = new DomainDao();
            $wid = $domainDao->findColumn('realm=?',$_SERVER['HTTP_HOST'],'wid');

            //获取站点信息
            if($wid) {
                $webDao = new WebsiteDao();
                $web = $webDao->findId($wid);

                if($web) {
                    return $web;
                }
            }
            return false;
        });
        $result or die('It`s not a website!');
        $this->config($result);
    }

    public function config($config){

        $usr = $config['name'];

        //$this->default_module='content';
        $this->default_index = 'archives/index';
        //$this->module = ['content','doc'];

        $this->wid           = $config['id'];//站点ID
        $this->uid           = 1;//用户ID
        $this->usr           = $usr;//用户名,即用户空间,子级用户的空间为父级空间

        $this->usr_dir       = $this->usr_dir.$usr.DS;

        //相对于用户目录的路径
        $this->usr_plugins           = '/plugins/';
        $this->usr_themes            = '/themes/';
        $this->usr_langs             = '/langs/';
        $this->usr_uploads           = '/uploads/';

        $this->usr_url               = $this->usr_url.$usr.DS;

        //用户相对目录
        $this->usr_relative_dir      = '/115';

        //用户根目录
        $this->usr_root_dir          = $this->usr_url;

        $this->namespace    = [
            'helper'   => 'application\helper',
            'logic'     => 'application\logic',
            //'util'      => 'application\vars\util',
            'ixr'       => 'application\vars\ixr',
            'plugin'    => $this->usr_dir.'plugins',
        ];

        //缓存目录路径,需要填写绝对路径
        $this->path_temp  = $this->usr_dir.'tmp'.DS;

        //文件缓存配置
        $this->filecache   = [
            'timeout'    => 86400,
            'ext' => '.cache',
        ];

        //模版引擎配置
        $this->templates = [
            'tpl_replace_string' => [
                '_static_'  =>'/style/',
                '_url_'    =>'/',
                '_usr_'    =>$this->usr_url,
                '_themes_' =>"/usr/{$usr}/themes/",
                '_uploads_'=>"/usr/{$usr}/uploads/",
                '_plugins_'=>"/usr/{$usr}/plugins/",
            ],
            'tpl_cache' => true,
        ];

        $this->dblite             = [
            'driver'	=> 'sqlite',
            'prefix'    => 'e_', // 数据库表前缀
            'dbname'    => $this->usr_dir.'db/cehoo.db',
        ];

        $this->router();
    }

    public function router(){
        if(is_file(Config::getx('path_temp').'router.php')) {
            $this->router = include Config::getx('path_temp').'router.php';
            return;
        }
        $dao = new Dao('option','id',$this->dblite);
        $result = $dao->find('name=?','routingTable');
        $this->router = unserialize($result['value']);
    }
}