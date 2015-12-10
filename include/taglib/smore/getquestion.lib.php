<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 获取某条产品问答信息标签
 *
 * @version        $Id: getquestion.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

 

function lib_getquestion(&$ctag,&$refObj)
{
    global $dsql;
    $attlist="row|,typeid|,row|8,productid|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);

    $innertext = trim($ctag->GetInnertext());
	$productid=isset($refObj->Fields['id']) ? $refObj->Fields['id']:$productid;
	$typeid=isset($refObj->Fields['typeid']) ? $refObj->Fields['typeid']:0;
    $where = $typeid==0 ? '' : "and typeid={$typeid}";

	$typenamelist=array('1'=>'lines','2'=>'hotels','3'=>'cars','4'=>'raider','5'=>'spots','6'=>'photos');
	
	

	//if($postid==''||$typeid=='')return;//如果文章id为空则返回
    $revalue = '';
    if(!empty($productid))
	{
	  
	   $sql="select * from #@__question where replycontent is not null and productid='$productid' {$where} order by replytime desc limit 0,{$row} ";//查询单个
	}
	else
	{
	   $sql="select * from #@__question where  replycontent is not null {$where} order by replytime desc limit 0,{$row}";  //查询全部
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
		if($row['questype']==0)
        {
            $productinfo=GetProductInfo($row['typeid'],$row['productid']);
            $row['productname']=$productinfo['title'];
            $row['producturl']=$productinfo['url'];
        }
        else
        {
            $row['productname'] = $row['title'];
        }

        $row['nickname'] = empty($row['nickname']) ? '匿名' : $row['nickname'];
		
        foreach($ctp->CTags as $tagid=>$ctag)
        {
              
				 $row['replycontent'] = preg_replace('/<p>(.*)<\/p>/', '$1', $row['replycontent']);//替换到P标签
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

function GetParentKindidC($id)
{
    global $dsql;

	$row=$dsql->GetOne("select pid from #@__destinations where id='{$id}'");

	return $row['pid'];
}
function GetProductInfo($typeid,$productid)
{
	global $dsql;
	$tablearr=array('1'=>'#@__line','2'=>'#@__hotel','3'=>'#@__car','4'=>'#@__article','5'=>'#@__spot','6'=>'#@__photo','13'=>'#@__tuan');
	$table=$tablearr[$typeid];
	if(empty($table))
	 return null;
	$row=$dsql->GetOne("select * from $table where id=$productid");
	if(!empty($row))
	{
	   $weburl=GetWebURLByWebid($row['webid']);	
	  switch($typeid)
	  {
		 case 1:
		    $row['title']=$row['title']; 
			$row['url']=$weburl."/lines/show_{$row['aid']}.html";
		    break;
		 case 2:
		    $row['title']=$row['title'];
			$row['url']=$weburl."/hotels/show_{$row['aid']}.html";
			break;
		 case 3:
		    $row['title']=$row['title'];
			$row['url']=$weburl."/cars/show_{$row['aid']}.html";
			break;
	     case 4:
		    $row['title']=$row['title'];
			$row['url']=$weburl."/raiders/show_{$row['aid']}.html";
			break;
		 case 5:
		   $row['title']=$row['title'];
		   $row['url']=$weburl."/spots/show_{$row['aid']}.html";
		   break;
		 case 13:
		   $row['title']=$row['title'];
		   $row['url']=$weburl."/tuan/show_{$row['aid']}.html";
		   break;  				
		 
	  }
	}
    return $row;
	
}