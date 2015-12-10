<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 云搜索调用标签(废弃)
 *
 * @version        $Id: cloudsearch.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
  

 

function lib_cloudsearch(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|20,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
 
    $innertext = trim($ctag->GetInnertext());
	
	$ResultList=isset($refObj->Fields['ResultList'])?$refObj->Fields['ResultList']:'';
	
	$keyword=$refObj->Fields['keyword'];
	
	//print_r($ResultList);
	
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	
	
    for($i=0;isset($ResultList[$i]);$i++)
    {
        $GLOBALS['autoindex']++;
		$row=$ResultList[$i];
		$row['description']=setColor($keyword,cutstr_html($row['content'],90));
		$row['channelname']=getChannelName($row['tablename']);
		$row['title']=setColor($keyword,$row['title']);
		$row['litpic']=getLitpic($row['imgurl'],$row['webid'],$row);
		$row['website']=GetWebURLByWebid($row['webid']);
		$row['weburl']=$row['website'];
		$row['url']=getUrl($row['aid'],$row['webid'],$row['tablename'],$row['tag']);
		
        foreach($ctp->CTags as $tagid=>$ctag)
        {
               
				if($ctag->GetName()=='array')
                {
                        $ctp->Assign($tagid, $row);
                }
                else
                {
                    if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]); 
					else $ctp->Assign($tagid,'');
                }
        }
        $revalue .= $ctp->GetResult();
    }
    return $revalue;
}
//获取channelname
function getChannelName($tablename)
{
	$arr=array('sline_line'=>'线路',
	           'sline_hotel'=>'酒店',
			   'sline_car'=>'车务',
			   'sline_article'=>'攻略',
			   'sline_spot'=>'景点',
			   'sline_photo'=>'相册',
			   'sline_leave'=>'问答');
   $out=$arr[$tablename];
   return $out;
	
	
}
function getPreUrl($tablename,$webid)
{
	$weburl=GetWebURLByWebid($webid);
	if($webid!=0)
	{
		$arr=array('sline_line'=>'/lines/',
	           'sline_hotel'=>'/hotels/',
			   'sline_car'=>'/cars/',
			   'sline_article'=>'/raider/',
			   'sline_spot'=>'/spots/',
			   'sline_photo'=>'/photos/',
			   'sline_leave'=>'/questions/');
	}
	else
	{
		$arr=array('sline_line'=>'/lines/',
	           'sline_hotel'=>'/hotels/',
			   'sline_car'=>'/cars/',
			   'sline_article'=>'/raiders/',
			   'sline_spot'=>'/spots/',
			   'sline_photo'=>'/photos/',
			   'sline_leave'=>'/questions/');
	}
   $out=$weburl.$arr[$tablename];
   return $out;
	
	
}
//获取图像
function getLitpic($imgurl,$webid,$row)
{
	$litpic='';
	$linkurl=getUrl($row['aid'],$row['webid'],$row['tablename'],$row['tag']);
	if(!empty($imgurl))
	{
	  $url=GetWebURLByWebid($webid);
	  $litpic=$url.$imgurl;
	  $litpic=" <li class=\"search_img_1\"><a href=\"{$linkurl}\" target=\"blank\"><img src=\"{$litpic}\" width=\"112\" height=\"84\" /></a></li>";
	}
	
	
	return $litpic;
	
}
//获取链接地址
function getUrl($aid,$webid,$tablename,$tag)
{
	$url=getPreUrl($tablename,$webid);
	if($tablename!='sline_photo')
	{
	  $url.="show_{$aid}.html";	
	}
	else
	{
	  $url.="show_{$aid}_{$tag}.html";	
	}
	return $url;
}

//设置关键词颜色
function setColor($keyword,$value)
{
	
	$str=str_replace($keyword,"<span class=\"color\">{$keyword}</span>",$value);
	return $str;
	
}