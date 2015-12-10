<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Uploader extends Stourweb_Controller{

  /*
   * 上传图片处理控制器(一般图片上传)
   *
   */
    public function action_uploadnormal()
    {
       var_dump($_FILES['Filedata']);

    }

    public function action_uploadfile()
    {
        $webid = ARR::get($_POST,'webid');
        $thumb = ARR::get($_POST,'thumb');;//是否生成缩略图
        //echo $thumb;

        $webinfo = Common::getWebInfo($webid);

        $pinyin = $webid!=0 ? $webinfo['webprefix'] : 'main';

        $file=$_FILES['Filedata'];


        $storepath = BASEPATH.'/uploads/'.$pinyin;
        if(!file_exists($storepath))
        {
            $this->createStandDir($storepath);//创建标准图片存储
        }
        //缩略图存储
        $storearr = array(
                array('/uploads/'.$pinyin.'/litimg/'.date('Ymd'),480,320),
                array('/uploads/'.$pinyin.'/lit240/'.date('Ymd'),240,180),
                array('/uploads/'.$pinyin.'/lit160/'.date('Ymd'),160,80),
        );
        $dir=BASEPATH."/uploads/".$pinyin."/allimg/".date('Ymd'); //原图存储路径.

        if(!file_exists($dir))
         mkdir($dir);
        $path_info=pathinfo($_FILES['Filedata']['name']);
        $filename=date('YmdHis');
        $i=0;

        while(file_exists($dir.'/'.$filename.'.'.$path_info['extension']))
        {

            $i = $i+50;
            $filename = date('YmdHis').$i;

        }

        $filename =$filename.'.'.$path_info['extension'];

        Upload::$default_directory=$dir;//默认保存文件夹
        Upload::$remove_spaces=true;//上传文件删除空格

        if(Upload::valid($file))
        {
            if(Upload::size($file,"2M"))
            {
                if(Upload::type($file,array('jpg', 'png', 'gif')))
                {

                    if(Upload::save($file,$filename))
                    {
                        $srcfile = $dir.'/'.$filename; //原图

                        $water = Common::getConfig('watermark');//获取水印配置文件


                        //是否生成缩略图
                        if($thumb!='false')
                        {
                            if($water['watermark']['photo_markon'] == '1')
                            {

                                $this->setWater(
                                    $srcfile,
                                    $water['watermark']['photo_markimg'],
                                    $water['watermark']['photo_marktext'],
                                    $water['watermark']['photo_fontcolor'],
                                    $water['watermark']['photo_waterpos'],
                                    $water['watermark']['photo_fontsize'],
                                    $water['watermark']['photo_marktype'],
                                    $water['watermark']['photo_diaphaneity']
                                );
                            }

                           foreach($storearr as $path)
                           {

                               $newpath = BASEPATH.$path[0];
                               $newfile = BASEPATH.$path[0].'/'.$filename;
                               $this->thumbPicture($srcfile,$newfile,$newpath,$path[1],$path[2],$filename);

                           }
                        }

                        //echo substr(substr($newfile,strpos($dir,'/uploads')-1),1);
                        $arr['success'] = 'true';
                        $arr['bigpic'] = $GLOBALS['$cfg_basehost'].substr(substr($srcfile,strpos($dir,'/uploads')-1),1);
                        $arr['litpic'] = $GLOBALS['$cfg_basehost'].$storearr[0][0].'/'.$filename;


                    }
                    else
                    {
                        //echo "error_no";
                        $arr['success'] = 'false';
                        $arr['msg'] = '未知错误,上传失败';
                    }
                }
                else
                {
                    $arr['success'] = 'false';
                    $arr['msg'] = '类型不支持';
                }
            }
            else
            {
                $arr['success'] = 'false';
                $arr['msg'] = '图片大小超过限制';
            }
        }
        else
        {
            $arr['success'] = 'false';
            $arr['msg'] = '未知错误,上传失败';
        }
        echo json_encode($arr);

    }


    /*
     * 上传网站头像
     * */
    public function action_uploadico()
    {
        $file=$_FILES['Filedata'];
        $storepath = BASEPATH;
        $filename = 'favicon.ico';
        Upload::$default_directory=$storepath;//默认保存文件夹
        Upload::$remove_spaces=true;//上传文件删除空格

        if(Upload::valid($file))
        {
            if(Upload::size($file,"2M"))
            {
                if(Upload::type($file,array('ico')))
                {

                    if(Upload::save($file,$filename))
                    {


                        //echo substr(substr($newfile,strpos($dir,'/uploads')-1),1);
                        $arr['success'] = 'true';
                        $arr['bigpic'] = $GLOBALS['cfg_basehost'].'/favicon.ico';
                        $arr['litpic'] = $GLOBALS['cfg_basehost'].'/favicon.ico';


                    }
                    else
                    {
                        //echo "error_no";
                        $arr['success'] = 'false';
                        $arr['msg'] = '未知错误,上传失败';
                    }
                }
                else
                {
                    $arr['success'] = 'false';
                    $arr['msg'] = '类型不支持';
                }
            }
            else
            {
                $arr['success'] = 'false';
                $arr['msg'] = '图片大小超过限制';
            }
        }
        else
        {
            $arr['success'] = 'false';
            $arr['msg'] = '未知错误,上传失败';
        }
        echo json_encode($arr);
    }


    /*
     * 模板中上传文件
     * */
    public function action_uploadotherfile()
    {
        $basefolder = BASEPATH.'/templets/smore/uploadtemplets/';

        $path = ARR::get($_POST,'path');
        $filedata = ARR::get($_FILES,'filedata');

        $filepath = $basefolder.$path.'/'.$filedata['name'];//文件上传路径



        $out = array();

        if(move_uploaded_file($filedata['tmp_name'],$filepath))
        {
            $out = array(
            'text' => $filedata['name'],
            'id'   => $path.'/'.$filedata['name'],
            'leaf' => true,
            'qtip' => '',
            'ext' => ''
            );
        }

        echo json_encode($out);


    }


    /*
     * 上传水印图片
     * */
    public function action_uploadmarkimg()
    {
        $dir = SLINEDATA.'/mark'; //水印图片存储目录
        if(!is_dir($dir))
        {
            mkdir($dir);
        }
        $path_info=pathinfo($_FILES['Filedata']['name']);
        $filename='mark.'.$path_info['extension'];
        Upload::$default_directory=$dir;//默认保存文件夹
        Upload::$remove_spaces=true;//上传文件删除空格
        $file=$_FILES['Filedata'];
        $arr = array();
        if(Upload::valid($file) && Upload::size($file,"500KB") && Upload::type($file,array('jpg','png', 'gif')))
        {
            if(Upload::save($file,$filename))
            {
                $arr['success'] = 'true';
                $arr['bigpic'] = $GLOBALS['$cfg_basehost'].'/data/mark/'.$filename;
            }

        }
        else
        {
            $arr['success'] = 'false';
            $arr['msg'] = '上传失败,请检查图片大小,图片格式.';
        }
        echo json_encode($arr);


    }
    /*
     * 删除图片
     * */
    public function action_delpicture()
    {
        $pic = ARR::get($_POST,'picturepath');

        Common::deleteRelativeImage($pic);

        echo 'ok';

    }

    /*
     * 上传DOC文档
     * */
    public function action_uploaddoc()
    {
        $basefolder = BASEPATH.'/uploads/main/doc/';

        $filedata = ARR::get($_FILES,'Filedata');
        $path_info= pathinfo($filedata['name']);
        $filename = date('YmdHis');
        $filepath = $basefolder.$filename.'.'.$path_info['extension'];//文件上传路径



        $out = array();

        if(move_uploaded_file($filedata['tmp_name'],$filepath))
        {
            $out = array(
                'status' => true,
                'path'   => $GLOBALS['cmsurl'].'/uploads/main/doc/'.$filename.'.'.$path_info['extension']

            );
        }

        echo json_encode($out);

    }



   /*
    * 为子站创建图片目录
    * */
   private function createStandDir($dir)
   {


          $arr=array(
              'adimg',
              'allimg',
              'arcimgs',
              'doc',
              'lit160',
              'lit240',
              'litimg',
              'thumbs'
          );
          //先创建根
          mkdir($dir);
          foreach($arr as $url)
          {
              $doc = $dir.'/'.$url;
              mkdir($doc);
          }


   }

   /*
    * 生成缩略图
    * */
    private function thumbPicture($srcfile,$savepath,$newpath,$w,$h,$filename)
    {


        if(!file_exists($newpath))
            mkdir($newpath);

        Image::factory($srcfile)
            ->resize($w, $h, Image::NONE)
            ->save($savepath,80);
        return $savepath;


    }
    //添加水印

    /*----

    $imgSrc：目标图片，可带相对目录地址，
    $markImg：水印图片，可带相对目录地址，支持PNG和GIF两种格式，如水印图片在执行文件mark目录下，可写成：mark/mark.gif
    $markText：给图片添加的水印文字
    $TextColor：水印文字的字体颜色
    $markPos：图片水印添加的位置，取值范围：0~9
    0：随机位置，在1~8之间随机选取一个位置
    1：顶部居左 2：顶部居中 3：顶部居右 4：左边居中
    5：图片中心 6：右边居中 7：底部居左 8：底部居中 9：底部居右
    $fontType：具体的字体库，可带相对目录地址
    $markType：图片添加水印的方式，img代表以图片方式，text代表以文字方式添加水印



    ----------*/


    private  function setWater($imgSrc,$markImg,$markText,$TextColor,$markPos,$fontSize,$markType,$markDiaphaneity)
    {


        $srcInfo = @getimagesize($imgSrc);
        $srcImg_w    = $srcInfo[0];
        $srcImg_h    = $srcInfo[1];
        if($srcImg_w<300) return;


        switch ($srcInfo[2])
        {
            case 1:
                $srcim =imagecreatefromgif($imgSrc);
                break;
            case 2:
                $srcim =imagecreatefromjpeg($imgSrc);
                break;
            case 3:
                $srcim =imagecreatefrompng($imgSrc);
                break;
            default:
                die("不支持的图片文件类型");
                exit;
        }

        if(!strcmp($markType,"img")) //使用图片加水印.
        {
            $markImg = SLINEDATA.'/mark/'.$markImg;

            if(!file_exists($markImg) || empty($markImg))
            {
                return;
            }

            $markImgInfo = getimagesize($markImg);

            $markImg_w    = $markImgInfo[0];
            $markImg_h    = $markImgInfo[1];

            //如果水印图大于要加水印的图片,则退出.
            /* if($markWidth < $markImg_w || $markHeight < $markImg_h)
             {
                 return;
             }*/

            switch ($markImgInfo[2])
            {
                case 1:
                    $markim =imagecreatefromgif($markImg);
                    break;
                case 2:
                    $markim =imagecreatefromjpeg($markImg);
                    break;
                case 3:
                    $markim =imagecreatefrompng($markImg);
                    break;
                default:
                    die("不支持的水印图片文件类型");
                    exit;
            }

            $logow = $markImg_w;
            $logoh = $markImg_h;
        }

        if(!strcmp($markType,"text"))
        {
            // $fontSize = 16;

            $fontType=SLINEDATA."/mark/STXINWEI.TTF";

            if(!empty($markText))
            {
                if(!file_exists($fontType))
                {
                    echo " fonttype not exist";
                    return;
                }
            }
            else {
                return;
            }

            $box = @imagettfbbox($fontSize, 0, $fontType,$markText);

            $logow = max($box[2], $box[4]) - min($box[0], $box[6]);
            $logoh = max($box[1], $box[3]) - min($box[5], $box[7]);
        }

        if($markPos == 0)
        {
            $markPos = rand(1, 9);
        }

        switch($markPos)
        {
            case 1:
                $x = +5;
                $y = +20;
                break;
            case 2:
                $x = ($srcImg_w - $logow) / 2;
                $y = +20;
                break;
            case 3:
                $x = $srcImg_w - $logow - 5;
                $y = +20;
                break;
            case 4:
                $x = +5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 5:
                $x = ($srcImg_w - $logow) / 2;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 6:
                $x = $srcImg_w - $logow - 5;
                $y = ($srcImg_h - $logoh) / 2;
                break;
            case 7:
                $x = +5;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 8:
                $x = ($srcImg_w - $logow) / 2;
                $y = $srcImg_h - $logoh - 5;
                break;
            case 9:
                $x = $srcImg_w - $logow - 5;
                $y = $srcImg_h - $logoh -5;
                break;
            default:
                die("此位置不支持");
                exit;
        }

        $dst_img = @imagecreatetruecolor($srcImg_w, $srcImg_h);
        imagecopy ( $dst_img, $srcim, 0, 0, 0, 0, $srcImg_w, $srcImg_h);

        if(!strcmp($markType,"img"))
        {
            imagecopy($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh);
            //imagedestroy($markim);
            //imagealphablending($watermark_logo, true);
            //imagecopymerge($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh, $markDiaphaneity);

           // self::imagecopymerge_alpha($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh, $markDiaphaneity);
           // imagecopy($dst_img, $markim, $x, $y, 0, 0, $logow, $logoh);
            //imagealphablending($markim, true);
            //imagecopy($dst_img,$markim,$x-$xy,$dst_info[1]-$src_info[1]-10,0,0,$src_info[0],$src_info[1]);
            //$b_img = imagecreatetruecolor($srcImg_w, $srcImg_h);
            //imagecopy($b_img, $markim, 0, 0, 0, 0, $srcImg_w, $srcImg_h);
           // imagecopy($b_img, $markim, $x, $y, 0, 0,$logow, $logoh);
           // $dst_img = $b_img;
            imagedestroy($markim);

        }

        if(!strcmp($markType,"text"))
        {
            $TextColor=str_replace('rgb(','',$TextColor);
            $TextColor=str_replace(')','',$TextColor);
            $rgb = explode(',', $TextColor);

            $color = imagecolorallocate($dst_img, intval($rgb[0]), intval($rgb[1]), intval($rgb[2]));

            imagettftext($dst_img, $fontSize, 0, $x, $y, $color, $fontType,$markText);


        }


        switch ($srcInfo[2])
        {
            case 1:
                imagegif($dst_img, $imgSrc);
                break;
            case 2:
                imagejpeg($dst_img, $imgSrc);
                break;
            case 3:
                imagepng($dst_img, $imgSrc);
                break;
            default:
                die("不支持的水印图片文件类型");
                exit;
        }

        imagedestroy($dst_img);
        imagedestroy($srcim);
    }
    private  static function imagecopymerge_alpha($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $pct){
        $opacity=$pct;
        // getting the watermark width
        $w = imagesx($src_im);
        // getting the watermark height
        $h = imagesy($src_im);

        // creating a cut resource
        $cut = imagecreatetruecolor($src_w, $src_h);
        // copying that section of the background to the cut
        imagecopy($cut, $dst_im, 0, 0, $dst_x, $dst_y, $src_w, $src_h);
        // inverting the opacity
        //$opacity = 100 - $opacity;

        // placing the watermark now
        imagecopy($cut, $src_im, 0, 0, $src_x, $src_y, $src_w, $src_h);
        imagecopymerge($dst_im, $cut, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h, $opacity);
    }




}