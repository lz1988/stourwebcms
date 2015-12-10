<?php

interface InterfaceImage
{
    //获取目录列表
    public function image_dir_list($dir);

    //扫描指定目录图片
    public function image_dir_scan($dir, $basedir);

    //文件移动
    public function image_move($source, $dest);
    //
}