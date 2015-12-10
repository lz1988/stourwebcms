<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}

 

function lib_getarctaglist(&$ctag,&$refObj)
{
    global $dsql, $sys_webid;
    $attlist="row|8";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	$tagword=isset($refObj->Fields['tagword'])?$refObj->Fields['tagword']:'';
	if($tagword=='') return '';
	$tagword=RemoveEmpty(explode(",",$tagword));
	$i=1;
	$where='';
	foreach($tagword as $key=>$value)
	       {
		     
				 if($i==1)
				 {
					$where.="tagword like '%$value%'";
				  }
				   else
				   {
					 $where.=" or tagword like '%$value%'";
				   }
				   $i++;
			 
		   }

    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$sql="select aid,title,shownum,attrid,webid from #@__article  where $where limit 0,$row";
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
    while($row = $dsql->GetArray())
    {
	    $weburl=GetWebURLByWebid($row['webid']);
		if($row['webid'] == 0)
		{
			$row['url']=$GLOBALS['cfg_cmsurl']."/raiders/show_{$row['aid']}.html";
			$row['litpic']=!empty($row['litpic'])?$GLOBALS['cfg_cmsurl'].$row['litpic']:$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
		}
		else
		{
			$row['url']=GetWebURLByWebid($row['webid'])."/raider/show_{$row['aid']}.html";
			$row['litpic']=!empty($row['litpic'])?$weburl.$row['litpic']:$GLOBALS['cfg_cmsurl']."/templets/default/images/pic_tem.gif";
		}
		
		$row['title']=$row['title'];
		$row['attrname']=Getarctype($row['attrid']);
		
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
		$GLOBALS['autoindex']++;
    }
    return $revalue;
}
function Getarctype($attrid)
{
   global $dsql;
   $name='其它';
   if(!empty($attrid))
   {
     $sql="select attrname from #@__article_attr where id in($attrid)";
     $row=$dsql->GetOne($sql);
	 $name=$row['attrname'];
   }
   return $name;

}