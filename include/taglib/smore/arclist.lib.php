<?php   if(!defined('SLINEINC')) exit('Request Error!');

 
require_once(SLINEINC.'/view.class.php');

function lib_arclist(&$ctag,&$refObj)
{
    global $dsql;
    include(SLINEDATA."/webinfo.php");
    $attlist="flag|,groupname|";
	FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = trim($ctag->GetInnerText());
    $artlist = '';
    if($innertext=='') return '';
   
    //获得类别ID总数的信息
    $ids = array();
	$typenames=array();
	$pids = array();

	
	if($flag == 'attrlist')
	{
		$sql = "select id from #@__article_attr where attrname='$groupname'";
		$ar = $dsql->GetOne($sql);
		$pid = $ar['id'];
		$sql = "select id,attrname from #@__article_attr where pid = '$pid'";
	}
	
    $dsql->SetQuery($sql);
    $dsql->Execute();
    while($row = $dsql->GetArray()) 
	{
        $ids[] = $row['id'];
		$kindnames[]=$row['attrname'];//获取子栏目名称
    }

    if(!isset($ids[0])) return ''; //如里不存在子栏目则退出

    $GLOBALS['itemindex']=0;
	
    for($i=0;isset($ids[$i]);$i++)
    {
        $GLOBALS['itemindex']++;
        $pv = new View($ids[$i]);
		
		
		$pv->Fields['attrid']=$ids[$i];
		$pv->Fields['kindname']=$kindnames[$i];
		
        $pv->SetTemplet($innertext,'string');
        $artlist .= $pv->GetResult();
    }
  
    return $artlist;
}

 ?>
