<?php

require_once 'interfaceimage.php';
class Local implements InterfaceImage
{
    //文件夹列表
    public function image_dir_list($dir)
    {
        $dirArr = array();
        if ($handler = opendir($dir)) {
            while ($file = readdir($handler)) {
                $path = realpath("{$dir}/{$file}");
                if (is_dir($path)) {
                    if (in_array($file, array('.', '..'))) {
                        continue;
                    }
                    if (preg_match('/^[a-zA-z0-9]+$/', $file)) {
                        $dirArr[] = $path;
                        $dirArr = array_merge($dirArr, self::image_dir_list($path));
                    }
                }
            }
            closedir($handler);
        }
        return $dirArr;
    }

    //移动文件
    public function image_move($source, $dest)
    {
     $dir=dirname($dest);
     if(!file_exists($dir)){
         mkdir($dir,0777,true);
     }
    return rename($source,$dest);
    }

    //扫描指定目录图片
    public function image_dir_scan($dir, $basedir)
    {
        $files = array();
        $dir = $basedir . $dir;
        if ($handler = opendir($dir)) {
            while ($file = readdir($handler)) {
                $path = realpath("{$dir}/{$file}");
                if (is_file($path)) {
                    if (preg_match('/^[a-zA-z0-9=&,]+\.(gif|png|jpg|jpeg)$/', $file)) {
                        array_push($files, array(str_replace(array($basedir, '\\'), array('', '/'), $path),filesize($path)));
                    }
                }
            }
            closedir($handler);
        }
        return $files;
    }
}