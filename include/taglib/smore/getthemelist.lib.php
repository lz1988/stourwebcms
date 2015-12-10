<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 专题标签代码
 *
 * @version        $Id: getthemelist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

 

function lib_getthemelist(&$ctag,&$refObj)
{
    global $dsql;
	include(SLINEDATA."/webinfo.php");
    $attlist="typeid|0,row|8,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	
	$tablelist=array("1"=>"#@__line","2"=>"#@__hotel","3"=>"#@__car","4"=>"#@__article","5"=>"#@__spot","6"=>"#@__photo");
	$themeid=$refObj->Fields['themeid'];
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$sql="";
	if(!empty($typeid))
	{
	   switch($typeid)
	   {
		   case 1:
		     $fields="a.aid,a.id,a.webid,a.title as title,a.seotitle,a.sellpoint,a.litpic,a.storeprice,a.price,a.linedate,a.transport,a.lineday,a.startcity,a.overcity,a.shownum,a.satisfyscore,a.bookcount";
			 $orderby=" order by a.isding desc,a.displayorder asc";
			 break;
		  case 2:
		     $fields=" a.*,a.title as title ";
			 $orderby=" order by a.isding desc,a.displayorder asc";
			 break;
		  case 3:
		     $fields=" a.*,a.title as title";
			 $orderby=" order by a.istop desc";
			 break;
		  case 4:
		     $fields=" a.aid,a.webid,a.allow,a.title as title,a.seoname,a.shownum,a.content,a.addtime,a.webid,a.attrid,a.litpic ";
			 $orderby=" order by a.isding desc,displayorder asc";
			 break;
		  case 5:
		     $fields=" a.aid,a.id,a.title as title,a.isspotarea,a.litpic,a.price,a.area,a.spotpicid,a.tagword,a.kindlist,a.webid,a.attrid ";
			 $orderby=" order by a.isding desc,displayorder asc";
			 break;
		  case 6:
		     $fields=" a.aid,a.title,a.seoname,a.headimg,a.content,a.title as littitle,a.alt,a.author,a.shownum,a.webid,a.headimgid";
			 $orderby=" order by a.isding desc,orderid asc  ";
			 break; 
	   }
	   $sql="select {$fields} from  {$table[$typeid]} where FIND_IN_SET($themeid,a.themelist) {$orderby} limit 0,$row";	
	}
	else if($type=='themelist')
	{
	    $sql="select a.*,a.ztname as title from #@__theme as a";	
	}
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
	
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
