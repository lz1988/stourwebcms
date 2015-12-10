<?php defined('SYSPATH') or die('No direct script access.');

class Image
{
    //实例化image对象
    private $obj;
    //image 配置文件
    private $config;
    //上传目录
    private $upload;
    //网站根目录
    private $basedir;

    public function __construct()
    {
        $this->config = include dirname(dirname(__FILE__)) . '/config/image.php';
        if ($this->config['remote_image']) {
            //远程图片
            include 'remote.php';
            $this->obj = new Remote($this->config['ftp_host'], $this->config['ftp_user'], $this->config['ftp_pwd'], $this->config['ftp_port']);
            $this->basedir = rtrim($this->config['remote_upload'], '/');
            $this->upload = $this->basedir . $this->config['upload_path'];
        } else {
            //本地图片
            include 'local.php';
            $this->obj = new Local();
            $this->basedir = BASEPATH;
            $this->upload = realpath($this->basedir . $this->config['upload_path']);
        }
    }

    /**
     * 获取图片目录列表
     * @return array
     */
    public function image_dir_list($path='')
    {
        $dirpath=str_replace('\\','/',$this->upload.str_replace($this->config['upload_path'],'',$path));
        $data = $this->obj->image_dir_list($dirpath);
        foreach ($data as $k => $v) {
            $v = str_replace(array($this->basedir, '\\'), array('', '/'), $v);
            $data[$k] = array('path' => $v, 'val' => $v);
        }
        if(empty($data)){
          $data[0]=array('path'=>$path,'val'=>$path);
        }
        return $data;
    }

    /**
     * 扫描指定目录图片
     * @param $dir
     * @return int
     */
    public function image_dir_scan($dir)
    {
        return $this->obj->image_dir_scan(rtrim($dir,'/'), $this->basedir);

    }

    /**
     * 移动图片
     * @param $source
     * @param $dest
     * @return boolean
     */
    public function image_move($source, $dest){
        return $this->obj->image_move($source, $this->upload.$dest);
    }
}
