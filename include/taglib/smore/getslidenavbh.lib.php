<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 调用子分类标签
 *
 * @version        $Id: getslidenav.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 

 
$outlist='';
function lib_getslidenavbh(&$ctag,&$refObj)
{
    global $dsql,$outlist;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $kindid=$refObj->Fields['kindid'];
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
	$sql="select id,kindname as categoryname,linkurl as url,color from #@__plugin_leftnav where pid='{$kindid}' and isopen=1 order by displayorder asc";
	$arr=$dsql->getAll($sql);
	for($i=0;isset($arr[$i]);$i++)
	{
        $row=$arr[$i];
	    $row['categorychild']=getCategoryChild2($row['id']);
        $row['categoryname'] =  !empty($row['color']) ? '<font color="'.$row['color'].'">'.$row['categoryname'].'</font>' : $row['categoryname'];
		if(!empty($row['url']) && $row['url']!="http://")
		{
		   $row['categoryname']="<a href=\"{$row['url']}\" target=\"_blank\" >{$row['categoryname']}</a>";
		}
		$temlevel = 1;
		foreach ($row['categorychild'] as $key => $value) {
			$row['categorychild'][$key]['nextnav'] = getCategoryChild2($value['id']);
			if(!empty($row['categorychild'][$key]['nextnav'])){
				$temlevel=2;
			}
		}
		$temstr = "";
		if($temlevel==2){
			$temstr .= "<dl>";
            $temstr .= "<dt>".$row['categoryname']."</dt>";
            $temstr .= "</dl>";
			foreach ($row['categorychild'] as $key => $value) {
				$temstr .= "<dl>";
            	$temstr .= "<dt>".$value['categoryname']."</dt>";
            	$temstr .= "<dd>";
            	foreach ($value['nextnav'] as $k => $v) {
            		$temstr .= $v['categoryname'];
            	}
            	$temstr .= "</dd>";
            	$temstr .= "</dl>";
			}
		}else{
			$temstr .= "<dl>";
        	$temstr .= "<dt>".$row['categoryname']."</dt>";
        	$temstr .= "<dd>";
			foreach ($row['categorychild'] as $key => $value) {
				$temstr .= $value['categoryname'];
			}
			$temstr .= "</dd>";
            $temstr .= "</dl>";
		}

		$row['kindlistnav'] = $temstr;
		$ctp = new STTagParse();
		$ctp->SetNameSpace("field","[","]");
		$ctp->LoadSource($innertext);
		$outlist='';
	   
	
			
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

//根据kindid获取下级分类
function getCategoryChild2($kindid)
{
	 global $dsql;
	 $outlist='';
	 $sql="select id,kindname,linkurl,color from #@__plugin_leftnav where pid='$kindid' and isopen=1 order by displayorder asc";
	 
	 $arr=$dsql->getAll($sql);
  
	 for($i=0;isset($arr[$i]);$i++)
	  {
		    $row=$arr[$i];
	        $kindname = !empty($row['color']) ? '<font color="'.$row['color'].'">'.$row['kindname'].'</font>' : $row['kindname'];
	        if(!empty($row['url']) && $row['url']!="http://")
			{
	        	$arr[$i]['categoryname'] = " <a href=\"{$row['linkurl']}\" target=\"_blank\" >{$kindname}</a>";
	    	}else{
	    		$arr[$i]['categoryname'] = " <a href=\"javascript:void(0);\">{$kindname}</a>";
	    	}	
	  }
	  return $arr;

}

