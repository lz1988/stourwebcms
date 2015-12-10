<?php
/**
 * 公共静态类模块
 * User: Netman
 * Date: 14-4-1
 * Time: 下午1:48
 */
class Common {

   public static $pinyin = array();
   public static $channel = array(
       '1'=>'线路',
       '2'=>'酒店',
       '3'=>'租车',
       '5'=>'门票',
       '8'=>'签证',
       '13'=>'团购'
   );
    /**
     *  获取编辑器
     *
     * @access    public
     * @param     string  $fname 表单名称
     * @param     string  $fvalue 表单值
     * @param     string  $nheight 内容高度
     * @param     string  $etype 编辑器类型
     * @param     string  $gtype 获取值类型
     * @param     string  $isfullpage 是否全屏
     * @return    string
     */
   public static function getEditor($fname,$fvalue,$nwidth="700",$nheight="350",$etype="Sline",$ptype='',$gtype="print",$jsEditor=false)
    {


            require(DOCROOT . '/public/vendor/slineeditor/ueditor.php');
            $UEditor = new UEditor();
            $UEditor->basePath = $GLOBALS['cfg_cmspath'].'/public/vendor/slineeditor/';
            $nheight = $nheight==400 ? 300 : $nheight;
            $config = $events = array();
            $GLOBALS['tools'] = empty($toolbar[$etype])? $GLOBALS['tools'] : $toolbar[$etype] ;
            $config['toolbars'] = $GLOBALS['tools'];
            $config['minFrameHeight'] = $nheight;
            $config['initialFrameHeight'] = $nheight;
            $config['initialFrameWidth'] = $nwidth;
			if(!$jsEditor)
		    {
              $code = $UEditor->editor($fname, $fvalue, $config, $events);
			}
			else
		    {
			  $code = $UEditor->jseditor($fname,$fvalue,$config,$events);
			}

            if($gtype=="print")
            {
                echo $code;
            }
            else
            {
               return $code;
            }

    }
    //根据用，号隔开的字符串，生成script标签
    public static function getScript($filelist,$default=true)
    {
        $filearr = explode(',',$filelist);
        //$theme = Kohana::$config->load('webinfo','theme');
        $out = '';
        foreach($filearr as $file)
        {
            if($default == true)
            {
                $tfile = DOCROOT."/public/js/".$file;

                $dfile = "/public/js/{$file}"; //从系统目录读取

                $_tfile = DOCROOT.'/public/'.$GLOBALS['cfg_templet'].'/js/'.$file;//当前模板目录

                $_dfile = "/public/{$GLOBALS['cfg_templet']}/js/{$file}";
            }
            else
            {
                $tfile = DOCROOT.$file;
            }
            if(file_exists($_tfile))
            {
                $out.=HTML::script($_dfile);
            }
            else if(file_exists($tfile))
            {
                $out.=HTML::script($dfile);
            }

        }
        return $out;

    }
    //根据用，号隔开的字符串，生成style标签
    public static function getCss($filelist,$folder='css')
    {
        $filearr = explode(',',$filelist);
        $out = '';
        //$theme = Kohana::$config->load('webinfo','theme');
        foreach($filearr as $file)
        {
            $tfile = DOCROOT."/public/{$folder}/".$file; //系统资源路径
            $dfile = "/public/{$folder}/{$file}"; //从系统目录读取

            $_tfile = DOCROOT.'/public/'.$GLOBALS['cfg_templet'].'/'.$folder.'/'.$file;//当前模板目录
            $_dfile = "/public/{$GLOBALS['cfg_templet']}/{$folder}/{$file}";

            if(file_exists($_tfile))
            {
                $out.=HTML::style($_dfile);
            }
            else if(file_exists($tfile)) //如果不存在则从系统资源目录读取
            {
                $out.=HTML::style($dfile);
            }

        }
        return $out;
    }
    /*
     * 获取配置文件值
     * */
    public static function getConfig($group)
    {
        return Kohana::$config->load($group);
    }
    /*
     * 获取子站点信息
     *@param int webid
     *@return array
     *
     */
    public static function getWebInfo($webid)
    {
        $row = ORM::factory('weblist')
                  ->where('webid','=',$webid)
                  ->find()->as_array();
        return $row;
    }

    /*
     * 获取子站列表
     * return array
     * */
    public static function getWebList()
    {
        $arr = ORM::factory('weblist')->where('webid!=0','','')->get_all();

        return $arr;
    }

    /*
     * ico图标获取
     * @parameter string
     * @return img string
     * */
    public static function getIco($type,$helpid=0)
    {
        switch($type)
        {
            case 'help':
                $out = "<img class='fl' style='cursor:pointer' src='".$GLOBALS['cfg_public_url']."images/help-ico.png' onclick='ST.Util.helpBox(this,".$helpid.",event)' />";
                break;
            case 'edit':
                $out = "<img class='' src='".$GLOBALS['cfg_public_url']."images/xiugai-ico.gif' />";
                break;
            case 'del':
                $out = "<img class='' src='".$GLOBALS['cfg_public_url']."images/del-ico.gif' />";
                break;
            case 'hide':
                $out = "<img class='' src='".$GLOBALS['cfg_public_url']."images/close-s.png' data-show='0' />";
                break;
            case 'show':
                $out = "<img class='' src='".$GLOBALS['cfg_public_url']."images/show-ico.png' data-show='1' />";
                break;
            case 'preview':
                $out = "<img class='' src='".$GLOBALS['cfg_public_url']."images/preview.png' data-show='1' />";
                break;
        }

        return $out;
    }
    /*
     * 获取aid
     * @param string table
     * @param int webid
     * @return lastaid
     * */
    public static function getLastAid($tablename,$webid=0)
    {
            $aid=1;//初始值
            $sql="select max(aid) as aid from {$tablename} where webid=$webid order by id desc";
            $row= DB::query(1,$sql)->execute()->as_array();
            if(is_array($row))
            {
                $aid=$row[0]['aid']+1;
            }
            return $aid;
    }
    /*
	删除一个图片及它的所有缩略图和原图
	*/
	public static function deleteRelativeImage($imgpath)
	{
		if(empty($imgpath))
		    return;
		unlink(BASEPATH.$imgpath);
		$dir_arr=array('lit240','allimg','lit160','litimg');
		$dir_rep='';
		foreach($dir_arr as $k=>$v)
		{
			if(strpos($v,$imgpath)!==false)
			{
			   $dir_rep=$v;
			   unset($dir_arr[$k]);
			   break;
			}
		}
		if(!$dir_rep)
		{
			return;
		}
		foreach($dir_arr as $k=>$v)
		{
			$del_path=str_replace($dir_rep,$v,$imgpath);
			unlink(BASEPATH.$del_path);
		}

	}
	/*
	   删除内容里的图片
	*/
	public static function deleteContentImage($content,$folder='uploads')
	{
		$match=array();
		preg_match_all('/<img.+src=[\"\']?(.+\.(jpg|gif|bmp|bnp|png))[\"\']?.+\/?>/iU',$content,$match);
		$img_arr=$match[1];
		foreach($img_arr as $k=>$v)
		{
			$pos=strpos($v,$folder);
			if($pos===false)
			  continue;
			$img_relative_path=substr($v,$pos);
			$img_full_path=BASEPATH.'/'.$img_relative_path;
			unlink($img_full_path);
		}	
	}
    /*
     * 清空数组里的空值
     * */
    public static function removeEmpty($arr)
    {

            $newarr=array_diff($arr,array(null,'null','',' '));
            return $newarr;

    }
    /*
     * 根据,分隔的属性字符串获取相应的属性数组(修改页面用)
     */
    public static function getSelectedAttr($typeid,$attr_str)
    {
        $productattr_arr=array(1=>'line_attr',2=>'hotel_attr',3=>'car_attr',4=>'article_attr',5=>'spot_attr',6=>'photo_attr',13=>'tuan_attr');
        $attrid_arr=explode(',',$attr_str);
        $attr_arr=array();
        foreach($attrid_arr as $k=>$v)
        {
            $attr=ORM::factory($productattr_arr[$typeid])->where("pid!=0 and id='$v'")->find();
            if($attr->id)
            {
              $attr_arr[]=$attr->as_array();
            }
        }
        return $attr_arr;
    }
    /*
     * 根据,分隔的字符串获取图标数组(修改页面用)
     * */
    public static function getSelectedIcon($iconlist)
    {
       $iconid_arr=explode(',',$iconlist);
       $iconarr=array();
       foreach($iconid_arr as $k=>$v)
       {
           $icon=ORM::factory('icon',$v);
           if($icon->id)
               $iconarr[]=$icon->as_array();
       }

       return $iconarr;
    }
    /*
     * 根据逗号分隔的字符串供应商数组(修改页面用)
     * */
    public static function getSelectedSupplier($supplierlist)
    {
        $supplier_arr=explode(',',$supplierlist);
        $arr=array();
        foreach($supplier_arr as $k=>$v)
        {
            $row=ORM::factory('supplier',$v);
            if($row->id)
                $arr[]=$row->as_array();
        }

        return $arr;
    }

    /*
     * 根据,分隔字符串获取上传的图片数组(修改页面用)
     * */
    public static function getUploadPicture($piclist)
    {
        $out = array();

        $arr = self::removeEmpty(explode(',',$piclist));

        foreach($arr as $row)
        {
            $picinfo = explode('||',$row);
            $out[]=array('litpic'=>$picinfo[0],'desc'=>isset($picinfo[1]) ? $picinfo[1] : '');
        }
        return $out;
    }
    /*
     * 获取默认图片
     * */
    public static function getDefaultImage()
    {
        $cfg_df_img = Common::getSysConf('value','cfg_df_img',0);//获取默认图片.
        $weburl = $GLOBALS['webinfo']['weburl'];
        return !empty($cfg_df_img) ? $weburl.$cfg_df_img : $GLOBALS['cfg_public_url'].'images/nopic.jpg';
    }
    /*
     * 生成缩略图
     *
     * */
    public static function thumb($srcfile,$savepath,$w,$h)
    {
        Image::factory($srcfile)
            ->resize($w, $h,Image::WIDTH)
            ->save($savepath);
        return $savepath;
    }
    /*
     * 时间转换函数
     * */
    public static function myDate($format,$timest)
    {
        $addtime = 8 * 3600;
        if(empty($format))
        {
            $format = 'Y-m-d H:i:s';
        }
        return gmdate ($format, $timest+$addtime);
    }
    /*
     * 获取网站http网址
     * */
    public static function getWebUrl($webid=0)
    {
        return $GLOBALS['cfg_basehost'];
    }

    /*
    * 获取文件扩展名
    * */
    public static function getExtension($file)
    {
        return end(explode('.', $file));
    }

    /*
     * 级联删除文件夹
     */
    public static function rrmdir($dir) {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != "." && $object != "..") {
                    if (filetype($dir."/".$object) == "dir") self::rrmdir($dir."/".$object); else unlink($dir."/".$object);
                }
            }
            reset($objects);
            rmdir($dir);
        }

    }
    /*
     * 调试信息
     * */
    public static function debug($log)
    {

        ChromePhp::log($log);

    }
    /*
     * 保存文件
     * */
    public static function saveToFile($file,$content)
    {

        $fp = fopen($file,"wb");
        flock($fp,3);
        //@flock($this->open,3);
        $result = fwrite($fp,$content);
        fclose($fp);
        return $result;
    }
    /*
     * 获取编号
     * */
    //获取编号,共6位,不足6位前面被0
    public static function getSeries($id,$prefix)
    {
          $ar = array(
            '01'=>'A',
            '02'=>'B',
            '05'=>'C',
            '03'=>'D',
            '08'=>'E',
            '13'=>'G'
          );
        $prefix = $ar[$prefix];
        $len=strlen($id);
        $needlen=4-$len;
        if($needlen==3)$s='000';
        else if($needlen==2)$s='00';
        else if($needlen==1)$s='0';

        $out=$prefix.$s."{$id}";
        return $out;

    }
    //检查一个串是否存在在某个串中
    public static function checkStr($str,$substr)
    {

        $tmparray = explode($substr,$str);
        if(count($tmparray)>1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    /*
     * 后台获取搜索词
     * */
    public static function getKeyword($keyword)
    {
        $keyword = str_replace(' ','',trim($keyword));
        $num = substr($keyword,1,strlen($keyword));
        $out = '';
        if(intval($num))
        {
            $out = intval($num);
        }
        else
        {
            $out = $keyword;
        }
       /* $flag = intval($keyword);

        if($flag)
        {
            $num = substr($keyword,1,strlen($keyword));

            $keyword = intval($num);
        }*/

        return $out;
    }
    /*
     * curl http访问
     * */
    public static function http($url,$method='get',$postfields='')
    {

        $ci=curl_init();

        curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);

        if($method=='POST')
        {
            curl_setopt($ci, CURLOPT_POST, TRUE);
            if($postfields!='')curl_setopt($ci, CURLOPT_POSTFIELDS, $postfields);
        }

        curl_setopt($ci, CURLOPT_URL, $url);
        $response=curl_exec($ci);
        curl_close($ci);
        return $response;

    }

    public static function objectToArray($array)
    {
        if(is_object($array)){
            $array = (array)$array;
        }
        if(is_array($array)){
            foreach($array as $key=>$value){
                $array[$key] = self::objectToArray($value);
            }
        }
        return $array;
    }
    /**
     *  获取拼音信息
     *
     * @access    public
     * @param     string  $str  字符串
     * @param     int  $ishead  是否为首字母
     * @param     int  $isclose  解析后是否释放资源
     * @return    string
     */
    public static function getPinYin($str, $ishead=0, $isclose=1)
    {
        $str = iconv('utf-8','gbk//ignore',$str);
        $restr = '';
        $str = trim($str);
        $slen = strlen($str);
        if($slen < 2)
        {
            return $str;
        }

        if(count(self::$pinyin) == 0)
        {
            $fp = fopen(PUBLICPATH.'/vendor/pinyin/pinyin.dat', 'r');
            while(!feof($fp))
            {
                $line = trim(fgets($fp));
                self::$pinyin[$line[0].$line[1]] = substr($line, 3, strlen($line)-3);
            }
            fclose($fp);
        }
        for($i=0; $i<$slen; $i++)
        {
            if(ord($str[$i])>0x80)
            {
                $c = $str[$i].$str[$i+1];
                $i++;
                if(isset(self::$pinyin[$c]))
                {
                    if($ishead==0)
                    {
                        $restr .= self::$pinyin[$c];
                    }
                    else
                    {
                        $restr .= self::$pinyin[$c][0];
                    }
                }else
                {
                    $restr .= "_";
                }
            }else if( preg_match("/[a-z0-9]/i", $str[$i]) )
            {
                $restr .= $str[$i];
            }
            else
            {
                $restr .= "_";
            }
        }
        if($isclose==0)
        {
            unset(self::$pinyin);
        }
        $sheng = "/.*sheng.*/";
        $shi = "/.*shi.*/";
        $qu = "/.*qu.*/";
        if(preg_match($sheng,$restr,$matches))
        {
            $restr = str_replace('sheng','',$matches[0]);
        }
        if(preg_match($shi,$restr,$matches))
        {
            $restr = str_replace('shi','',$matches[0]);
        }
        if(preg_match($qu,$restr,$matches))
        {
            $restr = str_replace('qu','',$matches[0]);
        }
        return $restr;
    }


    /*
     * 获取栏目详细页显示列表
     * */

    public static function getUserTemplteList($pagename)
    {
        $sql="select b.path from sline_page a left join sline_page_config b on a.id=b.pageid where a.pagename='$pagename'";
        $arr = DB::query(1,$sql)->execute()->as_array();
        foreach($arr as $key => $v)
        {
            if(!empty($v['path']))
            {
                $v['templetname'] = $v['path'];
                $v['path'] = 'uploadtemplets/'.$v['path'];
                $arr[$key] =$v;
            }
            else
            {
                array_pop($arr);
            }

        }
        return $arr;
    }

    /*
     * 获取某个配置值
     * */

    public static function getSysConf($field,$varname,$webid=0)
    {
        $result=DB::query(Database::SELECT,"select $field from sline_sysconfig where varname='$varname' and webid=$webid")->execute()->as_array();
        return $result[0][$field];
    }

    public static function getSysPara($varname)
    {
        return self::getSysConf('value',$varname,0);
    }

    public static function showMsg($msg,$gourl)
    {
        header("Content-type:text/html;charset=utf-8");
        if(!empty($msg))
            echo "<script>alert('$msg');</script>";
        if($gourl == -1)
        {

            echo "<script>window.history.go(-1);</script>";

        }
        else
        {
            echo "<script>window.location.href='$gourl';</script>";
        }
        exit;

    }
    public static function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {
        $ckey_length = 4;

        $key = md5($key ? $key : 'stourweb');
        $keya = md5(substr($key, 0, 16));
        $keyb = md5(substr($key, 16, 16));
        $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';

        $cryptkey = $keya.md5($keya.$keyc);
        $key_length = strlen($cryptkey);

        $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
        $string_length = strlen($string);

        $result = '';
        $box = range(0, 255);

        $rndkey = array();
        for($i = 0; $i <= 255; $i++) {
            $rndkey[$i] = ord($cryptkey[$i % $key_length]);
        }

        for($j = $i = 0; $i < 256; $i++) {
            $j = ($j + $box[$i] + $rndkey[$i]) % 256;
            $tmp = $box[$i];
            $box[$i] = $box[$j];
            $box[$j] = $tmp;
        }

        for($a = $j = $i = 0; $i < $string_length; $i++) {
            $a = ($a + 1) % 256;
            $j = ($j + $box[$a]) % 256;
            $tmp = $box[$a];
            $box[$a] = $box[$j];
            $box[$j] = $tmp;
            $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
        }

        if($operation == 'DECODE') {
            if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
                return substr($result, 26);
            } else {
                return '';
            }
        } else {
            return $keyc.str_replace('=', '', base64_encode($result));
        }

    }
    //验证是否登陆
    public static function checkLogin($secretkey)
    {
        $info = explode('||',self::authcode($secretkey));



        if(isset($info[0]) && $info[1])
        {
            $model = ORM::factory('member')->where("mobile='{$info[0]}' and pwd='{$info[1]}'")->find();


            if(isset($model->mid))
                return $model->as_array();
            else
                return 0;
        }
    }
    /*
     * 获取会员信息
     * */
    public static function getMemberInfo($mid)
    {
        $sql = "select * from sline_member where mid='$mid'";
        $info = DB::query(1,$sql)->execute()->as_array();

        return $info[0];

    }
    /**
     *获取消息msg定义
     * @param string msgtype
     */
    public static function getDefineMsgInfo($typeid,$num=0,$msgtype='')
    {
        $msgtype = empty($msgtype) ? self::getMsgType($typeid,$num) : $msgtype;
        $sql = "select * from sline_sms_msg where msgtype='{$msgtype}'";
        $row = DB::query(1,$sql)->execute()->as_array();
        return $row[0];
    }
    /*
     * 根据typeid生成msgtype
     * @param int $typeid
     * @param int $num ,第几个状态.
     * @return string $msgtype
     * */
    public static function getMsgType($typeid,$num)
    {
        switch($typeid)
        {
            case 1:
                $msgtype = 'line_order_msg'.$num;
                break;
            case 2:
                $msgtype = 'hotel_order_msg'.$num;
                break;
            case 3:
                $msgtype = 'car_order_msg'.$num;
                break;
            case 5:
                $msgtype = 'spot_order_msg'.$num;
                break;
            case 8:
                $msgtype = 'visa_order_msg'.$num;
                break;
            case 13:
                $msgtype = 'tuan_order_msg'.$num;
                break;

            default:
                $msgtype = 'reg';
                break;
        }
        return $msgtype;

    }

    //添加订单
    public static function addOrder($arr)
    {
        $model = ORM::factory('member_order');

        $flag = 0;
        if(is_array($arr))
        {
            if($arr['paytype']=='3')//这里补充一个当为二次确认时,修改订单为未处理状态.
            {
                $arr['status'] = 0;
            }
            foreach($arr as $k=>$v)
            {
                $model->$k=$v;
            }
            if($arr['typeid']==2)
            {
                $arr['pid'] = 0;
            }
            $mainid = $model->save();
            if($arr['typeid']==2)
            {
                $arr['ordersn'] = Common::getOrderSn('02');
                $arr['pid'] = $mainid;
                $m = ORM::factory('member_order');
                foreach($arr as $k=>$v)
                {
                    $m->$k=$v;
                }
                $m->save();

            }

            $flag = $model->saved();

            $memberinfo =self::getMemberInfo($arr['memberid']);
            $mobile = $memberinfo['mobile'];
            $prefix = !empty($memberinfo['nickname']) ? $memberinfo['nickname'] :$memberinfo['mobile'];
            $orderAmount = Common::StatisticalOrderAmount($model->as_array());

            if($arr['paytype']=='3') //二次确认支付
            {
                $msgInfo = self::getDefineMsgInfo($arr['typeid'],1);
                if($msgInfo['isopen']==1) //等待客服处理短信
                {
                    $content = $msgInfo['msg'];
                    $content = str_replace('{#MEMBERNAME#}',$memberinfo['nickname'],$content);
                    $content = str_replace('{#PRODUCTNAME#}',$arr['productname'],$content);
                    $content = str_replace('{#PRICE#}',$orderAmount['priceDescript'],$content);
                    $content = str_replace('{#NUMBER#}',$orderAmount['numberDescript'],$content);
                    $content = str_replace('{#TOTALPRICE#}',$orderAmount['totalPrice'],$content);
                    $content = str_replace('{#ORDERSN#}',$arr['ordersn'],$content);
                    self::sendMsg($mobile,$prefix,$content);//发送短信.
                }

            }
            else //全款支付/订金支付
            {
                $msgInfo = self::getDefineMsgInfo($arr['typeid'],2);
                if($msgInfo['isopen']==1)
                {
                    $content = $msgInfo['msg'];
                    $content = str_replace('{#MEMBERNAME#}',$memberinfo['nickname'],$content);
                    $content = str_replace('{#PRODUCTNAME#}',$arr['productname'],$content);
                    $content = str_replace('{#PRICE#}',$orderAmount['priceDescript'],$content);
                    $content = str_replace('{#NUMBER#}',$orderAmount['numberDescript'],$content);
                    $content = str_replace('{#TOTALPRICE#}',$orderAmount['totalPrice'],$content);
                    $content = str_replace('{#ORDERSN#}',$arr['ordersn'],$content);
                    self::sendMsg($mobile,$prefix,$content);//发送短信.
                }


            }

            $cfg_supplier_msg_open = self::getSysPara('cfg_supplier_msg_open');
            $content = self::getSysPara('cfg_supplier_msg');

            if($cfg_supplier_msg_open==1 )
            {

                $content = str_replace('{#LINKMAN#}',$arr['linkman'],$content);
                $content = str_replace('{#LINKNAME#}',$arr['linkman'],$content);
                $content = str_replace('{#PRODUCTNAME#}',$arr['productname'],$content);
                $content = str_replace('{#PHONE#}',$arr['linktel'],$content);
                $content = str_replace('{#PRICE#}',$orderAmount['priceDescript'],$content);
                $content = str_replace('{#NUMBER#}',$orderAmount['numberDescript'],$content);
                $content = str_replace('{#TOTALPRICE#}',$orderAmount['totalPrice'],$content);
                $content = str_replace('{#ORDERSN#}',$arr['ordersn'],$content);

                //本站管理员短信发送
                $cfg_webmaster_phone = self::getSysPara('cfg_webmaster_phone');
                if(!empty($cfg_webmaster_phone))
                {
                    self::sendMsg($cfg_webmaster_phone,$prefix,$content);//发送短信.
                }

                if(!empty($cfg_supplier_msg_open))
                {
                    $supplierphone = self::getSupplierTel($arr['productautoid'],$arr['typeid']);

                    if(!empty($supplierphone))
                    {
                        self::sendMsg($supplierphone,$prefix,$content);//发送短信.
                    }

                }
            }
        }

        return $flag;


    }
    /*
 * 获取产品对应的供应商
 * */
    public static function getSupplierTel($productid,$typeid)
    {
        global $dsql;

        $channeltable=array("1"=>"sline_line","2"=>"sline_hotel","3"=>"sline_car","4"=>"sline_article","5"=>"sline_spot","6"=>"sline_photo","10"=>"sline_leave","13"=>"sline_tuan");
        $table=$channeltable[$typeid];
        $sql = "select supplierlist from {$table} where id='$productid'";
        $row = DB::query(1,$sql)->execute()->as_array();
        $supplierid = $row[0]['supplierlist'];
        $sql = "select mobile from sline_supplier where id='$supplierid'";
        $row = DB::query(1,$sql)->execute()->as_array();
        return $row[0]['mobile'] ? $row[0]['mobile'] : '';


    }
    /*
    * 发送短信方法
    * @param int phone
    * @param string prefix
    * @param string content
    * */
    public static function sendMsg($phone,$prefix,$content)
    {
        include_once(PUBLICPATH.'/vendor/msg.class.php');
        $prefix = Common::getSysConf('value','cfg_webname',0);
        $sms_username = Common::getSysConf('value','cfg_sms_username',0);
        $sms_password = Common::getSysConf('value','cfg_sms_password',0);
        $msg = new Msg($sms_username,$sms_password);
        $status = $msg->sendMsg($phone,$prefix,$content);
        $status = json_decode($status);
        return $status;


    }

    /*
    * 发送邮件方法
    * @param string maillto 收件箱
    * @param string title  标题
    * @param string content 内容
    * */
    public static function ordermaill($maillto,$title,$content)
    {
    //##########################################
        
        //如果没有自定义SMTP配置
        $GLOBALS['cfg_mail_smtp'] = Common::getSysConf('value','cfg_mail_smtp',0);
        $GLOBALS['cfg_mail_port'] = Common::getSysConf('value','cfg_mail_port',0);
        $GLOBALS['cfg_mail_user'] = Common::getSysConf('value','cfg_mail_user',0);
        $GLOBALS['cfg_mail_pass'] = Common::getSysConf('value','cfg_mail_pass',0);
        if($GLOBALS['cfg_mail_smtp']==''){
            $GLOBALS['cfg_mail_smtp'] = "smtp.163.com";
        }
        if($GLOBALS['cfg_mail_port']==''){
            $GLOBALS['cfg_mail_port'] = 25;
        }
        if($GLOBALS['cfg_mail_user']==''){
            $GLOBALS['cfg_mail_user'] = "Stourweb@163.com";
            $GLOBALS['cfg_mail_pass'] = "kelly12345";
        }
        $smtpserver = $GLOBALS['cfg_mail_smtp'];//SMTP服务器
        $smtpserverport =$GLOBALS['cfg_mail_port'];//SMTP服务器端口
        $smtpusermail = $GLOBALS['cfg_mail_user'];//SMTP服务器的用户邮箱
        $smtpemailto =$maillto;//发送给谁
        $smtpuser = $GLOBALS['cfg_mail_user'];//SMTP服务器的用户帐号
        $smtppass = $GLOBALS['cfg_mail_pass'];//SMTP服务器的用户密码
        $mailtype = "HTML"; //邮件格式（HTML/TXT）,TXT为文本邮件

        ##########################################
        
        if($smtpserverport==25){

            include_once(PUBLICPATH.'/vendor/email.class.php');
            $mailsubject = iconv('UTF-8','GB2312//IGNORE',$title);//邮件主题
            $mailbody = iconv('UTF-8','GB2312//IGNORE',$content);//邮件内容
            $smtp = new smtp($smtpserver,$smtpserverport,true,$smtpuser,$smtppass);//这里面的一个true是表示使用身份验证,否则不使用身份验证.
            $smtp->debug = false;//是否显示发送的调试信息
            $status=$smtp->sendmail($smtpemailto, $smtpuser, $mailsubject, $mailbody, $mailtype);
        }else{

            include_once(PUBLICPATH.'/vendor/mysendmail.class.php');
            $mail = new MySendMail();
            $mail->setServer($smtpserver, $smtpuser, $smtppass, 465, true); //设置smtp服务器，到服务器的SSL连接
            $mail->setFrom($smtpuser); //设置发件人
            $mail->setReceiver($smtpemailto); //设置收件人，多个收件人，调用多次
            $mail->setMail($title, $content); //设置邮件主题、内容
            $status = $mail->sendMail(); //发送
        }
        
        
        return $status;
        
    }

    //在线支付公共接口
    /*-
	   $ordersn:订单编号
	   $subject:商品名称
	   $price:总价
	   $showurl:商品url
	-*/

    public static function payOnline($ordersn,$subject,$price,$paytype,$showurl='',$extra_para='',$widbody='')
    {



        if($paytype==1) //支付宝
        {
                $showurl=empty($showurl)?$GLOBALS['cfg_cmspath']:$showurl;
                $payurl=$GLOBALS['cfg_cmspath'].'thirdpay/alipay';
                $html="<form method='post' action='{$payurl}' name='alipayfrm'>";
                $html.='<input type="hidden" name="ordersn" value="'.$ordersn.'">';
                $html.='<input type="hidden" name="subject" value="'.$subject.'">';
                $html.='<input type="hidden" name="price" value="'.$price.'">';
                $html.='<input type="hidden" name="widbody" value="'.$widbody.'">';
                $html.='<input type="hidden" name="showurl" value="'.$showurl.'">';
                $html.='<input type="hidden" name="extra_common_param" value="'.$extra_para.'">';

                $html.='</form>';
                $html.="<script>document.forms['alipayfrm'].submit();</script>";
                return $html;


        }
        else if($paytype==2)  //快钱支付
        {
            $payurl=$GLOBALS['cfg_cmspath'].'/thirdpay/bill';

            $html="<form method='post' action='{$payurl}' name='billfrm'>";
            $html.='<input type="hidden" name="ordersn" value="'.$ordersn.'">';
            $html.='<input type="hidden" name="subject" value="'.$subject.'">';
            $html.='<input type="hidden" name="price" value="'.$price.'">';
            $html.='<input type="hidden" name="showurl" value="'.$showurl.'">';
            $html.='</form>';
            $html.="<script>document.forms['billfrm'].submit();</script>";
            return $html;
        }
        else if($paytype==3) //微信支付
        {
            $payurl=$GLOBALS['cfg_cmspath'].'/thirdpay/weixinpay';
            $html="<form method='post' action='{$payurl}' name='alipayfrm'>";
            $html.='<input type="hidden" name="ordersn" value="'.$ordersn.'">';
            $html.='<input type="hidden" name="subject" value="'.$subject.'">';
            $html.='<input type="hidden" name="price" value="'.$price.'">';
            $html.='<input type="hidden" name="widbody" value="'.$widbody.'">';
            $html.='<input type="hidden" name="showurl" value="'.$showurl.'">';
            $html.='<input type="hidden" name="extra_common_param" value="'.$extra_para.'">';

            $html.='</form>';
            $html.="<script>document.forms['alipayfrm'].submit();</script>";
            return $html;
        }


    }

	 public static   function clearHtml($content)
	 {  

	   $content = preg_replace("/<a[^>]*>/i", "", $content);
	   $content = preg_replace("/<\/a>/i", "", $content);
	   $content = preg_replace("/<div[^>]*>/i", "", $content);
	   $content = preg_replace("/<font[^>]*>/i", "", $content);
	   $content = preg_replace("/<strong[^>]*>/i", "", $content);
	   $content = preg_replace("/<\/font[^>]*>/i", "", $content);
	   $content = preg_replace("/<\/strong[^>]*>/i", "", $content);
	   $content = preg_replace("/<\/div>/i", "", $content); 
	   $content = preg_replace("/<p>/i", "", $content);    
	   $content = preg_replace("/<\/p>/i", "", $content);       
	   $content = preg_replace("/<!--[^>]*-->/i", "", $content);//注释内容
	   $content = preg_replace("/style=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/class=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/id=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/lang=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/width=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/height=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/border=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/face=.+?['|\"]/i",'',$content);//去除样式
	   $content = preg_replace("/face=.+?['|\"]/",'',$content);//去除样式 只允许小写 正则匹配没有带 i 参数

	   return $content;

	}
   /*
    * 字符串截取
    * */
	public static function cutstr_html($string, $sublen)    
	{

	  $string = strip_tags($string);

	  $string = preg_replace ('/\n/is', '', $string);

	  $string = preg_replace ('/ |　/is', '', $string);

	  $string = preg_replace ('/&nbsp;/is', '', $string);

	  preg_match_all("/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/", $string, $t_string);   

	  if(count($t_string[0]) - 0 > $sublen) $string = join('', array_slice($t_string[0], 0, $sublen))."…";   

	  else $string = join('', array_slice($t_string[0], 0, $sublen));

	  return $string;

	 }

    /*
     * 生成订单编号
     * */
    public static function getOrderSn($kind)
    {
        /* 选择一个随机的方案 */
        mt_srand((double) microtime() * 1000000);

        return $kind.date('md') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
    }

    /*
     * 获取栏目首页优化信息
     * */
    public static function getChannelSeo($typeid)
    {
        $sql = "select seotitle,keyword,description,shortname from sline_nav where typeid='$typeid' limit 1";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $ar[0]['seotitle'] = !empty($ar[0]['seotitle']) ? $ar[0]['seotitle'] : $ar[0]['shortname'];
        return $ar[0];
    }
    /*
     * 替换
     * */
    public static function pregReplace($str,$type)
    {
        $pattern = '';
        switch($type)
        {
            case '1': //只能有中文和英文
                $pattern = "/[^a-zA-Z\x7f-\xff]+/";
                break;
            case '2': //只能数字
                $pattern = "/[^0-9]/";
                break;
            case '3'://只能中文
                $pattern = "/[^\x7f-\xff]/";
                break;
            case '4'://只能有数字和_
                $pattern = "/[^0-9_]/";
                break;
        }
        $out = preg_replace($pattern,'',$str);
        return $out;

    }

    public static function StatisticalOrderAmount($orderinfo)
    {
        $result=array('totalNumber'=>0,'totalPrice'=>0,'numberDescript'=>'','priceDescript'=>'');
        if(is_array($orderinfo))
        {
            $totalPrice = $orderinfo['price'] * $orderinfo['dingnum']+$orderinfo['childnum']*$orderinfo['childprice']+$orderinfo['oldnum']*$orderinfo['oldprice'];
            $result['totalPrice']=$totalPrice;
            $totalNumber = $orderinfo['dingnum']+$orderinfo['childnum']+$orderinfo['oldnum'];
            $result['totalNumber']=$totalNumber;

            $priceDescript = '';
            $numberDescript='';
            if(!empty($orderinfo['dingnum']))
            {
                $priceDescript=$priceDescript.$orderinfo['price'].'(成)';
                $numberDescript=$numberDescript.$orderinfo['dingnum'].'(成)';
            }
            if(!empty($orderinfo['childnum']))
            {
                $priceDescript=$priceDescript.$orderinfo['childprice'].'(小)';
                $numberDescript=$numberDescript.$orderinfo['childnum'].'(小)';
            }
            if(!empty($orderinfo['oldnum']))
            {
                $priceDescript=$priceDescript.$orderinfo['oldprice'].'(老)';
                $numberDescript=$numberDescript.$orderinfo['oldnum'].'(老)';
            }

            if($orderinfo['typeid']!=1)
            {
                $priceDescript=$orderinfo['price'];
                $numberDescript=$orderinfo['dingnum'];
            }

            $result['priceDescript']=$priceDescript;
            $result['numberDescript']=$numberDescript;
            if($orderinfo['typeid']==2 && $orderinfo['pid']==0) {
                $numRow = DB::query(Database::SELECT,"select sum(dingnum) as num from sline_member_order where pid={$orderinfo['id']}")->execute()->as_array();
                $totalPriceArr=DB::query(Database::SELECT,"select sum(dingnum*price) as totalprice from sline_member_order where pid={$orderinfo['id']}")->execute()->as_array();
                $result['totalPrice']=$totalPriceArr[0]['totalprice'];
                $result['numberDescript']=$numRow[0]['num'];
            }
        }
        return $result;
    }
    public static function getEmailMsgConfig($msgtype)
    {

        $model = ORM::factory('email_msg');
        $row =  $model->where('msgtype','=',$msgtype)->find()->as_array();
        return $row;
    }
    public static function getEmailMsgConfig2($typeid,$num)
    {
        $model = ORM::factory('email_msg');
        $msgtype = self::getMsgType($typeid,$num);
        $row = $model->where('msgtype','=',$msgtype)->find()->as_array();
        return $row;
    }
    public static function addJifenLog($memberid,$content,$jifen,$type)
    {
        $model = ORM::factory('member_jifen_log');
        $model->memberid=$memberid;
        $model->content=$content;
        $model->jifen=$jifen;
        $model->type=$type;
        $model->addtime=time();
        $model->save();
    }

}
