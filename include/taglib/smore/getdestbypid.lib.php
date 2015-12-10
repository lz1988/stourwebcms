<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用分类标签(景点首页调用)
 *
 * @version        $Id: getcategory.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

function lib_getdestbypid(&$ctag,&$refObj)
{
    global $dsql,$outlist;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,pid|,limit|0,flag|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $kindid=$refObj->Fields['kindid'];
	
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
   
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
	
	
	
	if($flag=='spot')
	  {
		  
		  $sql="select a.kindname,a.id,b.displayorder,a.jieshao,a.pinyin from #@__destinations a inner join #@__spot_kindlist as b on a.id=b.kindid and a.pid=$kindid order by b.displayorder limit $limit,$row";
	  }else
	 $sql="select id,kindname,pinyin from #@__destinations where pid=$kindid and isopen=1 order by displayorder limit $limit,$row";
	
	 $rows=$dsql->getAll($sql);
	
      
	 foreach($rows as $row)
	 {
		 $row['kindid']=$row['id'];
        foreach($ctp->CTags as $tagid=>$ctag)
        {
                if($ctag->GetName()=='array')
                {
                        $ctp->Assign($tagid, $row);
                }
                else
                {
                    if( !empty($row[$ctag->GetName()])) $ctp->Assign($tagid,$row[$ctag->GetName()]); 
                }
        }
        $revalue .= $ctp->GetResult();
	}
    return $revalue;
}

//调用子级
function getChildHtml($kindid)
{
	  global $dsql;
	  $orderby=' order by c.isjian desc,case when c.displayorder is null then 9999 end,c.displayorder asc';
	  $where="where  FIND_IN_SET($kindid,a.kindlist) {$orderby}  limit 0,4";
      $sql="select a.* from #@__spot as a left join #@__kindorderlist as c on (c.classid=$kindid and a.id=c.aid and c.typeid=5)  $where";
      $result=$dsql->getAll($sql); 
	   foreach($result as $re)
	   {
	     $webroot=GetWebURLByWebid($re['webid']);
	     $litpic = getUploadFileUrl($re['litpic']);
		  $str.='<a href="'.$webroot.'/spots/show_'.$re['aid'].'.html"><img src="'.$litpic.'" alt="'.$re['title'].'" width="140" height="90" /></a>';
		  
	   }
	   return $str;
	
}

