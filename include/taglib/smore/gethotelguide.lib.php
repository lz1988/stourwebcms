<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 酒店分类导航调用标签
 *
 * @version        $Id: gethotelguide.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

 

function lib_gethotelguide(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|20,flag|";
	
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
	if(empty($flag)) return '';
	if($flag=='rank')
	{
      	$sql="select id,aid,hotelrank from #@__hotel_rank  where webid='0'  order by orderid asc limit 0,{$row}";
	}
	else if($flag=='price')
	{
	  	$sql="select id,aid,min,max from #@__hotel_pricelist where webid='0' limit 0,{$row}";
	}
	else if($flag == "kind")
	{
		$lid=$GLOBALS['locationid'];
		$sql = "select id,kindname from #@__hotel_kindlist where pid='36' and isopen='1'";
	}
	
	$innertext = trim($ctag->GetInnertext());
    $dsql->SetQuery($sql);
    $dsql->Execute();
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
    $GLOBALS['autoindex'] = 0;
	$revalue='';
    while($row = $dsql->GetArray())
    {
        $GLOBALS['autoindex']++;
		 
		if($flag=='rank')
		{
			
		    $row['title']=$row['hotelrank'];
			
		}
		else if($flag=='price')
		{
		 
		   
		  	if($row['min']!=''&& $row['max']!='')
		 	{
		    	$row['title']=$row['min'].'元~'.$row['max'].'元';
		 	}
		 	else if($row['min']=='')
		 	{
		    	$row['title']=$row['max'].'元以下';
		 	}
		 	else if($row['max']=='')
		 	{
		    	$row['title']=$row['min'].'元以上';
		 	}
		
		}
		
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
