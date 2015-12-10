<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(SLINEDATA."/webinfo.php");

//添加结伴信息.
if($dopost=='addjieban')
{
	$aid=GetLastAid('#@__leave');
	$time=time();
	$title="{$leavename}拼团结伴信息";
	$leaveip=GetIP();
	$sql="insert into #@__leave(webid,aid,leavename,qq,msn,email,title,content,leaveip,telephone,ishidden,addtime) values($sys_webid,'$aid','$leavename','$qq','$msn','$email','$title','$content','$leaveip','$telephone','$ishidden','$time')";
	if($dsql->ExecuteNoneQuery($sql))
    {
      echo 'ok';
    }
	
}
//获取目的地信息
if($dopost == 'getDest')
{
	$keyword = js_unescape($keyword);
	$rule = "/^[a-zA-Z]+$/i";
	if(!preg_match($rule, $keyword))
	{
		$sql = "select kindname from #@__destinations where isopen='1' and kindname like '%$keyword%' limit 0,10";
		$res = $dsql->getAll($sql);
		$str = '';
		foreach($res AS $row)
		{
			$row['kindname'] = str_replace($keyword, '<b>' . $keyword . '</b>', $row['kindname']);
			$str .= $row['kindname'] . ',';
		}
		$str = substr($str, 0, strlen($str)-1);
	}
	else
	{
		$str = matchPinyin($keyword, 'place');
	}
	echo $str;
	
}
//获取目的地ID
if($dopost == 'getDestId')
{
	$sql = "select id from #@__destinations where kindname='$destname'";
	$row = $dsql->GetOne($sql);
	echo $row['id'] ? $row['id'] : 36;
	
}
//获取目的地拼音
if($dopost == 'getDestPinYin')
{
	$sql = "select pinyin from #@__destinations where kindname='$destname'";
	$row = $dsql->GetOne($sql);
	echo $row['pinyin'] ? $row['pinyin'] : '';
	
}
//获取目的地下级html
if($dopost == 'getMddChild')
{
	Helper_Archive::loadModule('common');
	$model = new CommonModule('#@__destinations');
	$arr = $model->getAll("pid='$dest_id' and isopen=1");

	foreach($arr as $row)
	{
	  	$url = $GLOBALS['cfg_basehost'].'/'.$row['pinyin'].'/';
		$out.="<a href='{$url}' target='_blank'>{$row['kindname']}</a>";
	}
	
	echo ' <div class="pf">'.$out."</div>";
    exit();             
    
}

function matchPinyin($keyword)
{
	global $dsql;

	$sql = "select kindname as matchname from #@__destinations where isopen=1";	

	
	$res = $dsql->getAll($sql);
	$str = '';
	
	
	foreach($res AS $row) // 获取全部name
	{
		if(strlen($keyword) == 1)
		{
			$pinyin = GetPinyin($row['matchname']); // 获取拼音
			if(strpos($pinyin, $keyword) !== false)
			{
				if(substr($pinyin, 0, 1) == $keyword)
				{
					$str .= $row['matchname'] . ",";
				}
			}
		}
		else
		{
			$pinyin = GetPinyin($row['matchname'], 1); // 获取拼音
			if(strpos($pinyin, $keyword) !== false)
			{
				$str .= $row['matchname'] . ",";
			}
		}
	}
	
	$str = substr($str, 0, strlen($str)-1);
	return $str;
}

function js_unescape($str)
{
	$ret = '';
	$len = strlen($str);
	for ($i = 0; $i < $len; $i++)
	{
			if ($str[$i] == '%' && $str[$i+1] == 'u')
			{
					$val = hexdec(substr($str, $i+2, 4));
					if ($val < 0x7f) $ret .= chr($val);
					else if($val < 0x800) $ret .= chr(0xc0|($val>>6)).chr(0x80|($val&0x3f));
					else $ret .= chr(0xe0|($val>>12)).chr(0x80|(($val>>6)&0x3f)).chr(0x80|($val&0x3f));
					$i += 5;
			}
			else if ($str[$i] == '%')
			{
					$ret .= urldecode(substr($str, $i, 3));
					$i += 2;
			}
			else $ret .= $str[$i];
	}
	return $ret;
}

?>