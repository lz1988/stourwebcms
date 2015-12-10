<?php
require 'interfaceimage.php';
class Remote implements InterfaceImage
{
    private $ftp_host;
    private $ftp_port;
    private $ftp_user;
    private $ftp_pwd;
    private $link;
    private $tips;
    private $error = array(
        'connet' => array(
            'code' => 400,
            'info' => 'FTP 连接失败'
        ),
        'makedir' => array(
            'code' => 401,
            'info' => 'TFP 目录创建失败，请检查权限及路径是否正确！'
        ),
        'move' => array(
            'code' => 402,
            'info' => '文件移动失败,请检查权限及原路径是否正确！'
        )
    );

//初始化FTP连接
    public function __construct($host, $user, $password, $port = 21)
    {
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pwd = $password;
        if (!$this->remote_login()) {
            return $this->error['connet'];
            ext;
        }
    }

    //FTP登录
    private function remote_login()
    {
        $ftp_login = true;
        $connet = ftp_connect($this->host, $this->port);
        $login = ftp_login($connet, $this->user, $this->pwd);
        if (!$connet || $login) {
            $this->tips = 'connet';
            $ftp_login = false;
        }
        $this->link = $connet;
        ftp_pasv($this->link, true);
        return $ftp_login;
    }

    //目录列表
    public function image_dir_list($dir)
    {
        $dirArr = array();
        $files = ftp_rawlist($this->link, $dir);
        foreach ($files as $v) {
            $file = ltrim(strrchr($v, ' '), ' ');
            $path = "{$dir}/{$file}";
            if (preg_match('/^d/', $v)) {
                if (in_array($file, array('.', '..'))) {
                    continue;
                }
                if (preg_match('/^[a-zA-z0-9]+$/', $file)) { //遍历目录设置
                    $dirArr[] = $path;
                    $dirArr = array_merge($dirArr, self::image_dir_list($path));
                }
            }
        }
        return $dirArr;
    }

    //扫描指定目录图片
    public function image_dir_scan($dir, $basedir)
    {
        $data = array();
        $dir = $basedir . $dir;
        $files = ftp_rawlist($this->link, $dir);
        foreach ($files as $v) {
            $file = ltrim(strrchr($v, ' '), ' ');
            $path = "{$dir}/{$file}";
            if (preg_match('/^-/', $v)) {
                if (preg_match('/^[a-zA-z0-9]+\.(gif|png|jpg|jpeg)$/', $file)) { //遍历目录设置
                    array_push($data, array(str_replace($basedir, '', $path), ftp_size($this->link, $path)));
                }
            }
        }
        return $data;
    }

    //FTP 上传
    public function image_move($source, $dest)
    {
        $this->ftp_mkdir_recur($dest);
        $bool = ftp_put($this->link, $dest, $source, FTP_BINARY);
        if (!$bool) $this->tips = 'move';
        return $bool;
    }

    //递归生成目录
    function ftp_mkdir_recur($path)
    {
        $path_arr = explode('/', $path);
        array_pop($path_arr);
        $path_div = count($path_arr);
        foreach ($path_arr as $val) {
            if (@ftp_chdir($this->link, $val) == FALSE) {
                $tmp = @ftp_mkdir($this->link, $val);
                if ($tmp == FALSE) {
                    $this->tips = 'makedir';
                    exit;
                }
                @ftp_chdir($this->link, $val);
            }
        }
        for ($i = 1; $i <= $path_div; $i++) // 回退到根
        {
            @ftp_cdup($this->link);
        }
    }

    // FTP 断开连接
    private function image_close()
    {
        ftp_close($this->link);
    }

    public function __desctruct()
    {
        $this->image_close();
    }

}