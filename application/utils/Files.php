<?php
/**
 *
 * User: Collin
 * QQ: 1169986
 * Date: 16/5/16 下午5:15
 */
namespace utils;

class Files {


    private $mime = array(
        1=>'gif',
        2=>'jpeg',
        3=>'png',
        15=>'wbmp'
    );

    private $sourePrefix;
    private $distPrefix;

    public function __construct() {
    }

    public function setsPrefix($sourePrefix){
        $this->sourePrefix = $sourePrefix;
    }

    public function setdPrefix($distPrefix){
        $this->distPrefix  = $distPrefix;
    }

    /**
     * 制作一份规格图
     * @param $maxWidth
     * @param $maxHeight
     * @param $source
     * @param $dist
     * @return array|bool
     */
    public function makeSpec($maxWidth,$maxHeight,$source,$dist,$prefix=''){
        if(is_readable($dist)){
            $this->deldir($dist);
        }
        mkdir($dist,0700,true);
        if(is_string($source)){
            $source = [$source];
        }
        else if(!$source) {
            $source = [];
        }
        $files = [];
        $no = 0;
        foreach($source as $v) {
            $souFile = $prefix.$v;
            $distFile = $dist.'tmp_'.basename($souFile);
            //ed($souFile,$distFile);
            copy($souFile,$distFile);

            //缩减到指定宽度
            list($width, $height) = getimagesize($distFile);
            if($width > $maxWidth){
                $this->thumbnail($distFile,$maxWidth,null,$distFile);
            }

            //分割图片,使其不超过最大限制高度
            list($width, $height) = getimagesize($distFile);
            if($height > $maxHeight) {
                $no = $this->split($distFile,$maxHeight,null,$dist,$no);
                unlink($distFile);
            }

            if(is_file($distFile)){
                rename($distFile,$dist.$no.'.'.$this->getext($distFile));
                $no++;
            }
        }
        $glob = glob($dist.'*.*');
        foreach($glob as $v) {
            $temp = explode('/',$v);
            $temp = $temp[count($temp)-1];
            $temp = explode('.',$temp);
            $files[$temp[0]] = $v;
        }
        ksort($files);
        return $files;//glob($dist.'*.*');
    }


    /**
     * 获取文件扩展名
     * @param $file
     * @return mixed
     */
    function getext($file) {
        $file = explode('.', $file);
        return end($file);
    }

    /**
     * 删除一个目录
     * @param $dir
     * @return bool
     */
    function deldir($dir) {
        //先删除目录下的文件：
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                }
                else {
                    $this->deldir($fullpath);
                }
            }
        }
        closedir($dh);
        if(rmdir($dir)) {
            return true;
        }
        return false;
    }

    /**
     * 单个或批量复制文件
     * @param $oldname
     * @param $dist 要复制到的目录路径
     * @param bool $enablePrefix
     * @return bool
     */
    public function copy($oldname,$dist,$enablePrefix = true){
        $sprefix = $this->esprefix($enablePrefix);
        $dprefix = $this->edprefix($enablePrefix);
        $dist = $this->efmt($dprefix.$dist);
        if(!is_readable($dist)){
            is_file($dist) or mkdir($dist,0700,true);
        }
        if(is_string($oldname)){
            $oldname = array($oldname);
        }
        foreach($oldname as $v){
            copy($this->efmt($sprefix.$v),$dist.basename($v));
        }
        return true;
    }

    /**
     * 获取源文件前置路径
     * @param $enablePrefix
     * @param bool $issoure
     * @return string
     */
    private function esprefix($enablePrefix,$issoure=true){
        return $enablePrefix?$this->sourePrefix:'';
    }

    /**
     * 获取目标文件前置路径
     * @param $enablePrefix
     * @param bool $issoure
     * @return string
     */
    private function edprefix($enablePrefix){
        return $enablePrefix?$this->distPrefix:'';
    }

    private function efmt($path){
        return str_replace('//','/',$path);
    }

    /**
     * 单个或批量删除文件
     * @param $files
     * @param bool $enablePrefix
     * @return bool
     */
    public function del($files,$enablePrefix = true){
        if(is_string($files)) {
            $files = array($files);
        }
        $esprefix = $this->esprefix($enablePrefix);
        foreach ($files as $v){
            unlink($esprefix.$v);
        }
        return true;
    }


    /**
     * @param $oldname
     * @param $newname
     * @param bool $enablePrefix
     * @return bool单个或批量移动文件
     */
    public function move($oldname,$newname,$enablePrefix=true){
        if(!is_readable($newname)){
            is_file($newname) or mkdir($newname,0700,true);
        }
        if(is_string($oldname)){
            $oldname = array($oldname);
        }
        $prefix = $this->eprefix($enablePrefix);
        foreach($oldname as $v){
            rename($this->efmt($prefix.$v),$this->efmt($newname.basename($v)));
        }
        return true;
    }

    /**
     * 生成缩略图函数（支持图片格式：gif、jpeg、png和bmp）
     * @param $src 源图片路径
     * @param null $width 缩略图宽度（只指定高度时进行等比缩放）
     * @param null $height 缩略图高度（只指定宽度时进行等比缩放）
     * @param null $filename 保存路径（不指定时直接输出到浏览器）
     * @return bool
     *
     * $result = thumbnail('./IMG_3324.JPG', 147, 147);
     */
    function thumbnail($src, $width = null, $height = null, $filename = null) {
        if (!isset($width) && !isset($height))
            return false;
        if (isset($width) && $width <= 0)
            return false;
        if (isset($height) && $height <= 0)
            return false;

        $size = getimagesize($src);
        if (!$size)
            return false;

        list($src_w, $src_h, $src_type) = $size;
        $src_mime = $size['mime'];

        if(isset($this->mime[$src_type])){
            $img_type = $this->mime[$src_type];
        }
        else {
            return false;
        }
        if (!isset($width)){
            $width = $src_w * ($height / $src_h);
        }
        if (!isset($height)) {
            $height = $src_h * ($width / $src_w);
        }
        $imagecreatefunc = 'imagecreatefrom' . $img_type;
        $src_img = $imagecreatefunc($src);
        $dest_img = imagecreatetruecolor($width, $height);
        imagecopyresampled($dest_img, $src_img, 0, 0, 0, 0, $width, $height, $src_w, $src_h);

        $imagefunc = 'image' . $img_type;
        if ($filename) {
            $imagefunc($dest_img, $filename);
        }
        else {
            header('Content-Type: ' . $src_mime);
            $imagefunc($dest_img);
        }
        imagedestroy($src_img);
        imagedestroy($dest_img);
        return true;
    }

    /**
     * 按高度分割图片
     * @param $imgs
     * @param $maxheight
     * @param $maxwidth
     * @param $dispath
     */
    public function split($imgs,$maxheight,$maxwidth,$dispath,$stno=0,$quality=100){
        if(is_string($imgs)){
            $imgs = array($imgs);
        }
        foreach($imgs as $v){
            $filename = $v;
            //$p = 5;
            list($width, $height) = getimagesize($filename);

            $p = ceil($height / $maxheight);//切割的分数

            $newwidth = $width;
            $newheight = floor($height / $p);
            $last = $height % $p;
            $source = imagecreatefromjpeg($filename);
            for( $i=0 ; $i< $p; $i++ ){
                $_p = $newheight*$i;
                if(($i + 1) == $p){
                    $newheight += $last;
                }
                $thumb = ImageCreateTrueColor($newwidth, $newheight);
                imagecopyresized( $thumb, $source, 0, 0, 0, $_p, $newwidth,  $height, $width, $height);
                imagejpeg($thumb , "{$dispath}/{$stno}.jpg" ,$quality);
                $stno++;
            }
        }
        return $stno;
    }


    /**
     * 图片加水印（适用于png/jpg/gif格式）
     *
     * @author flynetcn
     *
     * @param $srcImg 原图片
     * @param $waterImg 水印图片
     * @param $savepath 保存路径
     * @param $savename 保存名字
     * @param $positon 水印位置
     * topcenter:顶部居左, topright:顶部居右, center:居中, bottomleft:底部局左, bottomright:底部居右
     * @param $alpha 透明度 -- 0:完全透明, 100:完全不透明
     *
     * @return 成功 -- 加水印后的新图片地址
     */
    public function imgwatermark($imgs, $waterImg, $alpha=30, $positon='bottomright', $distpath=null, $distname=null) {
        if(is_string($imgs)) {
            $imgs = [$imgs];
        }
        $dist = [];
        foreach($imgs as $v) {
            $srcImg = $v;
            $temp = pathinfo($srcImg);
            $name = $temp['basename'];
            $path = $temp['dirname'];
            $exte = $temp['extension'];
            $savename = $distname ? $distname : $name;
            $savepath = $distpath ? $distpath : $path;
            $savefile = $savepath .'/'. $savename;
            $srcinfo = @getimagesize($srcImg);
            if (!$srcinfo) {
                return false;//原文件不存在
            }
            $waterinfo = @getimagesize($waterImg);
            if (!$waterinfo) {
                return false;//水印图片不存在
            }
            $srcImgObj = $this->imagecreate($srcImg);
            if (!$srcImgObj) {
                return false;//原文件图像对象建立失败
            }
            $waterImgObj = $this->imagecreate($waterImg);
            if (!$waterImgObj) {
                return false;//水印文件图像对象建立失败
            }
            switch ($positon) {
                //1顶部居左
                case 'topcenter':
                    $x=$y=0;
                    break;
                //2顶部居右
                case 'topright':
                    $x = $srcinfo[0]-$waterinfo[0];
                    $y = 0;
                    break;
                //3居中
                case 'center':
                    $x = ($srcinfo[0]-$waterinfo[0])/2;
                    $y = ($srcinfo[1]-$waterinfo[1])/2;
                    break;
                //4底部居左
                case 'bottomleft':
                    $x = 0;
                    $y = $srcinfo[1]-$waterinfo[1];
                    break;
                //5底部居右
                case 'bottomright':
                    $x = $srcinfo[0]-$waterinfo[0];
                    $y = $srcinfo[1]-$waterinfo[1];
                    break;
                default:
                    $x=$y=0;
            }

            //半透明格式水印
            imagecopymerge($srcImgObj, $waterImgObj, $x, $y, 0, 0, $waterinfo[0], $waterinfo[1], $alpha);

            //支持png本身透明度的方式
            imagecopy($srcImgObj,$waterImgObj,$x,$y,0,0,$waterinfo[0],$waterinfo[1]);

            switch ($srcinfo[2]) {
                case 1:
                    imagegif($srcImgObj, $savefile);
                    break;
                case 2:
                    imagejpeg($srcImgObj, $savefile);
                    break;
                case 3:
                    imagepng($srcImgObj, $savefile);
                    break;
                default:
                    return false; //保存失败
            }
            imagedestroy($srcImgObj);
            imagedestroy($waterImgObj);
            $dist[] = $savefile;
        }
        return $dist;
    }


    /**
     * @param $imgfile
     * @return null|resource
     */
    private function imagecreate($imgfile) {
        $info = getimagesize($imgfile);
        switch ($info[2]) {
            case 1:
                return imagecreatefromgif($imgfile);
                break;
            case 2:
                return imagecreatefromjpeg($imgfile);
                break;
            case 3:
                return imagecreatefrompng($imgfile);
                break;
        }
        return null;
    }

}