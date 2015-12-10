<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(SLINEDATA."/webinfo.php");

//获取国家信息
if($dopost == 'getCountry')
{
	$keyword = Visa::js_unescape($keyword);
	$rule = "/^[a-zA-Z]+$/i";
	if(!preg_match($rule, $keyword))
	{
		$sql = "select kindname from sline_visa_area where isopen='1' and kindname like '%$keyword%' limit 0,10";
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
		$str = Visa::matchPinyin($keyword);
	}
	echo $str;
	
}
//获取国家拼音
if($dopost == 'getPinyin')
{
    $sql = "select pinyin from sline_visa_area where kindname='$countryname'";
    $row = $dsql->GetOne($sql);
    echo $row['pinyin'] ? $row['pinyin'] : '';

}



Class Visa{

   public static function matchPinyin($keyword)
    {
        global $dsql;

        $sql = "select kindname as matchname from sline_visa_area where isopen=1";


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
                $pinyin = GetPinyin($row['matchname'],1); // 获取拼音
                if(strpos($pinyin, $keyword) !== false)
                {
                    $str .= $row['matchname'] . ",";
                }
            }
        }

        $str = substr($str, 0, strlen($str)-1);
        return $str;
    }

    public static function js_unescape($str)
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

}


?>