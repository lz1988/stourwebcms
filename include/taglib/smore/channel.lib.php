<?php
/**
 * 获取栏目列表标签
 *
 * @version        $Id: channel.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

 
function lib_channel(&$ctag,&$refObj)
{
    global $dsql;
    $attlist = "row|100,type|son,typeid|0,flag|0";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	if($typeid==0) //当没有设置typeid时自动读取$typeid
	{
	  $typeid=isset($refObj->Fields['typeid'])?$refObj->Fields['typeid']:0;//
	}
	
	
    $innertext = $ctag->GetInnerText();
    $line = empty($row) ? 100 : $row;
    
    $likeType = '';

    $webid = $GLOBALS['sys_child_webid'];

    if($type=='top')
    {
		 if($flag=='product')
		 {
			$str="and typeid in(1,2,3,10)";
		 }
		 else if($flag=="article")
		 {
			$str="and typeid in(4,5,6)";
	     }
		 else
		 {
		  	$str="";
		 }
         $sql = "SELECT id,shortname,url,linktype,typeid,linktitle,kind From `#@__nav` WHERE isopen=1 and pid=0 {$str} and webid='$webid' order by displayorder asc limit 0, $line ";
    }
    else if($type=='son')
    {
        //if($typeid==0) return ''; //如果typeid=0,则返回
		$getsql="SELECT id from `#@__nav` where typeid=$typeid and webid=$sys_webid ";
		$row=$dsql->GetOne($getsql);
		$pid=$row['id'];
		if($typeid==0){
        $sql = "SELECT aid,shortname,linktype,url,kind From `#@__nav` WHERE pid='$pid' And isopen=1 and webid=$sys_webid and isopen=1 order by displayorder asc limit 0, $line ";}
		else{$sql = "SELECT aid,shortname,linktype,url,kind From `#@__nav` WHERE pid='$pid' and webid=$sys_webid order by displayorder asc limit 0, $line ";}
    }
	else if($type=='special') //首页左侧出行帮助
	{
		$getsql="SELECT id from `#@__nav` where typeid=$typeid and webid=$sys_webid";
		$row=$dsql->GetOne($getsql);
		$pid=$row['id'];
		$sql = "SELECT aid,shortname,linktype,url,kind From `#@__nav` WHERE pid='$pid'  and webid=$sys_webid and isopen=1 order by displayorder asc limit 0, $line ";
	}
  
    $needRel = false;
    $dtp2 = new STTagParse();
    $dtp2->SetNameSpace('field','[',']');
    $dtp2->LoadSource($innertext);



    if(empty($sql)) return '';
    $dsql->SetQuery($sql);
    $dsql->Execute();
    
    $totalRow = $dsql->GetTotalRow();
  
    $GLOBALS['autoindex'] = 0;
    for($i=0;$i < $totalRow;$i++)
    {
        $GLOBALS['autoindex']++;
         if($row=$dsql->GetArray())
		 {
              /*   if(preg_match("/http:\/\//",$row['url']))
				 {
					$row['url'] = $row['url'];
				 }
				 else
				 {
					$row['url'] = $GLOBALS['cfg_basehost'] . $GLOBALS['cfg_cmspath'] . $row['url'];
				 }
				
				if ($cur_url == $row['url'])
				 {
					$row['active'] = "ac";
				 }	*/
					$row['typelink']=!empty($row['linktype'])?$GLOBALS['cfg_basehost'].$GLOBALS['cfg_cmsurl'].$row['url']:$row['url'];

					if($row['url']=='/destination/')
					  $row['typelink']=$GLOBALS['cfg_basehost'].'/destination/';
					$row['typename'] = $row['shortname'];
					
                    if(is_array($dtp2->CTags))
                    {
                        foreach($dtp2->CTags as $tagid=>$ctag)
                        {
                            if($ctag->GetName()=='array')
							{
									$dtp2->Assign($tagid, $row);
							}
							else
							{
						      if(isset($row[$ctag->GetName()])) $dtp2->Assign($tagid,$row[$ctag->GetName()]);
							}
                        }
                    }
                    $likeType .= $dtp2->GetResult();
                
            }
       
            $GLOBALS['autoindex']++;
        
     
    }
   
    $dsql->FreeResult();
    
    return $likeType;
}


