<?php   if(!defined('SLINEINC')) exit('sline');
/**
 * 图像处理相关函数

 */
// ------------------------------------------------------------------------

/**
 *  缩图片自动生成函数，来源支持bmp、gif、jpg、png
 *  但生成的小图只用jpg或png格式
 *
 * @access    public
 * @param     string  $srcFile  图片路径
 * @param     string  $toW  转换到的宽度
 * @param     string  $toH  转换到的高度
 * @param     string  $toFile  输出文件到
 * @return    string
 */
if ( ! function_exists('ImageResize'))
{
    function ImageResize($srcFile, $toW, $toH, $toFile="")
    {
        global $cfg_photo_type;
        if($toFile=='') $toFile = $srcFile;
        $info = '';
        $srcInfo = GetImageSize($srcFile,$info);
        switch ($srcInfo[2])
        {
            case 1:
                if(!$cfg_photo_type['gif']) return FALSE;
                $im = imagecreatefromgif($srcFile);
                break;
            case 2:
                if(!$cfg_photo_type['jpeg']) return FALSE;
                $im = imagecreatefromjpeg($srcFile);
                break;
            case 3:
                if(!$cfg_photo_type['png']) return FALSE;
                $im = imagecreatefrompng($srcFile);
                break;
            case 6:
                if(!$cfg_photo_type['bmp']) return FALSE;
                $im = imagecreatefromwbmp($srcFile);
                break;
        }
        $srcW=ImageSX($im);
        $srcH=ImageSY($im);
        if($srcW<=$toW && $srcH<=$toH ) return TRUE;
        $toWH=$toW/$toH;
        $srcWH=$srcW/$srcH;
        if($toWH<=$srcWH)
        {
            $ftoW=$toW;
            $ftoH=$ftoW*($srcH/$srcW);
        }
        else
        {
            $ftoH=$toH;
            $ftoW=$ftoH*($srcW/$srcH);
        }
        if($srcW>$toW||$srcH>$toH)
        {
            if(function_exists("imagecreateTRUEcolor"))
            {
                @$ni = imagecreateTRUEcolor($ftoW,$ftoH);
                if($ni)
                {
                    imagecopyresampled($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
                }
                else
                {
                    $ni=imagecreate($ftoW,$ftoH);
                    imagecopyresized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
                }
            }
            else
            {
                $ni=imagecreate($ftoW,$ftoH);
                imagecopyresized($ni,$im,0,0,0,0,$ftoW,$ftoH,$srcW,$srcH);
            }
            switch ($srcInfo[2])
            {
                case 1:
                    imagegif($ni,$toFile);
                    break;
                case 2:
                    imagejpeg($ni,$toFile,85);
                    break;
                case 3:
                    imagepng($ni,$toFile);
                    break;
                case 6:
                    imagebmp($ni,$toFile);
                    break;
                default:
                    return FALSE;
            }
            imagedestroy($ni);
        }
        imagedestroy($im);
        return TRUE;
    }
}
 


/**
 *  获得GD的版本
 *
 * @access    public
 * @return    int
 */
if ( ! function_exists('gdversion'))
{
    function gdversion()
    {
        //没启用php.ini函数的情况下如果有GD默认视作2.0以上版本
        if(!function_exists('phpinfo'))
        {
            if(function_exists('imagecreate'))
            {
                return '2.0';
            }
            else
            {
                return 0;
            }
        }
        else
        {
            ob_start();
            phpinfo(8);
            $module_info = ob_get_contents();
            ob_end_clean();
            if(preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", $module_info,$matches))
            {
                $gdversion_h = $matches[1];
            }
            else
            {
                $gdversion_h = 0;
            }
            return $gdversion_h;
        }
    }
}


