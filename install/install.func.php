<?php
function RunMagicQuotes(&$str)
{
    if(!get_magic_quotes_gpc()) {
        if( is_array($str) )
            foreach($str as $key => $val) $str[$key] = RunMagicQuotes($val);
        else
            $str = addslashes($str);
    }
    return $str;
}
 function getServerFileUpload()
    {
        if (@ini_get('file_uploads')) {
            return '允许 '.ini_get('upload_max_filesize');
        } else {
            return '<font color="red">禁止</font>';
        }
    }
//获取磁盘空间
function getDiskSpace($dir)
{
		if(function_exists('disk_free_space')) 
		{
				$num = floor(disk_free_space($dir) / (1024*1024)).'M';
		} else 
		{
				$num = 'unknow';
		}
       return $num;
}


function gdversion()
{
  //没启用php.ini函数的情况下如果有GD默认视作2.0以上版本
  if(!function_exists('phpinfo'))
  {
      if(function_exists('imagecreate')) return '2.0';
      else return 0;
  }
  else
  {
    ob_start();
    phpinfo(8);
    $module_info = ob_get_contents();
    ob_end_clean();
    if(preg_match("/\bgd\s+version\b[^\d\n\r]+?([\d\.]+)/i", $module_info,$matches)) {   $gdversion_h = $matches[1];  }
    else {  $gdversion_h = 0; }
    return $gdversion_h;
  }
}

function GetBackAlert($msg,$isstop=0)
{
    global $s_lang;
    $msg = str_replace('"','`',$msg);
    if($isstop==1) $msg = "<script>\r\n<!--\r\n alert(\"{$msg}\");\r\n-->\r\n</script>\r\n";
    else $msg = "<script>\r\n<!--\r\n alert(\"{$msg}\");history.go(-1);\r\n-->\r\n</script>\r\n";
    $msg = "<meta http-equiv=content-type content='text/html; charset={$s_lang}'>\r\n".$msg;
    return $msg;
}


function TestWrite($d)
{
    $tfile = '_test.txt';
    $d = preg_replace("#\/$#", '', $d);
    $fp = @fopen($d.'/'.$tfile,'w');
    if(!$fp) return false;
    else
    {
        fclose($fp);
        $rs = @unlink($d.'/'.$tfile);
        if($rs) return true;
        else return false;
    }
}

function ReWriteConfigAuto()
{
    global $dsql;
    $configfile = DEDEDATA.'/config.cache.inc.php';
    if(!is_writeable($configfile))
    {
        echo "配置文件'{$configfile}'不支持写入，无法修改系统配置参数！";
        //ClearAllLink();
        exit();
    }
    $fp = fopen($configfile,'w');
    flock($fp,3);
    fwrite($fp,"<"."?php\r\n");
    $dsql->SetQuery("Select `varname`,`type`,`value`,`groupid` From `#@__sysconfig` order by aid asc ");
    $dsql->Execute();
    while($row = $dsql->GetArray())
    {
        if($row['type']=='number') fwrite($fp,"\${$row['varname']} = ".$row['value'].";\r\n");
        else fwrite($fp,"\${$row['varname']} = '".str_replace("'",'',$row['value'])."';\r\n");
    }
    fwrite($fp,"?".">");
    fclose($fp);
}

//更新栏目缓存
function UpDateCatCache()
{
    global $conn,$cfg_multi_site,$dbprefix;
    $cache1 = DEDEDATA."/cache/inc_catalog_base.inc";
    $rs = mysql_query("Select id,reid,channeltype,issend,typename From `".$dbprefix."arctype`", $conn);
    
    $fp1 = fopen($cache1,'w');
    $phph = '?';
    $fp1Header = "<{$phph}php\r\nglobal \$cfg_Cs;\r\n\$cfg_Cs=array();\r\n";
    fwrite($fp1,$fp1Header);
    while($row=mysql_fetch_array($rs))
    {
        $row['typename'] = base64_encode($row['typename']);
        fwrite($fp1,"\$cfg_Cs[{$row['id']}]=array({$row['reid']},{$row['channeltype']},{$row['issend']},'{$row['typename']}');\r\n");
    }
    fwrite($fp1,"{$phph}>");
    fclose($fp1);
}

function IsDownLoad($url) 
{
	if(file_exists($url.'.xml')){
		return true;
	}else{
		return false;
	}
}

function debug($log)
{
   
   //include(SLINEINC.'/chromephp.class.php');
 
   ChromePhp::log($log);	
}

function crView($conn)
{
		
		  $sql1="DROP VIEW IF EXISTS `sline_search`;";
		  $sql2="create view sline_search (channelname,webid,aid,typeid,title,description,litpic,shownum,kindlist,attrid,headimgid,tid,ishidden)
AS
SELECT '线路',webid,aid,1,title,features,litpic,shownum,kindlist,attrid,0,id,ishidden FROM sline_line
union
SELECT '酒店',webid,aid,2,title,content,litpic,shownum,kindlist,attrid,0,id,ishidden FROM sline_hotel
union
SELECT '车辆',webid,aid,3,title,content,litpic,shownum,kindlist,attrid,0,id,ishidden FROM sline_car
union
SELECT '攻略',webid,aid,4,title,content,litpic,shownum,kindlist,attrid,0,id,ishidden FROM sline_article
union
SELECT '景点',webid,aid,5,title,content,litpic,shownum,kindlist,attrid,0,id,ishidden FROM sline_spot
union
SELECT '相册',webid,aid,6,title,content,litpic,shownum,kindlist,attrid,headimgid,id,ishidden FROM sline_photo
union
SELECT '签证',webid,aid,8,title,content,litpic,shownum,'','',0,id,ishidden FROM sline_visa
union
SELECT '团购',webid,aid,13,title,content,litpic,shownum,kindlist,attrid,0,id,ishidden FROM sline_tuan";
	  mysql_query($sql1,$conn);
	  mysql_query($sql2,$conn);
	   
	
}