<?php
if(!defined('SLINEINC'))
{
   exit("Request Error!");
}
/**
 * 调用车务信息数据标签
 *
 * @version        $Id: getcarlist.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2013, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 
 

//require_once("carfun.php");
function lib_getcarbygroup(&$ctag,&$refObj)
{
	
    global $dsql,$sys_webid;
	$attlist="row|8,flag|0,limit|0";
	FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $innertext = $ctag->GetInnerText();
	$dtp2 = new STTagParse();
    $dtp2->SetNameSpace('field','[',']');
    $dtp2->LoadSource($innertext);
		//加目的地页面显示条件
	if($flag == 'bystyle')
    {
        $styleid = $refObj->Fields['styleid'];
        $sqlstr="select * from sline_car where carkindid='$styleid' limit {$limit},{$row}";
    }

	if(empty($sqlstr)) return '';
    $dsql->SetQuery($sqlstr);
    $dsql->Execute();
    $totalRow = $dsql->GetTotalRow();
	$likeType='';
    $GLOBALS['autoindex'] = 0;//??

	for($i=0;$i < $totalRow;$i++)
    {
         $GLOBALS['autoindex']++;
         if($tablerow=$dsql->GetArray())
		 {
             $url = GetWebURLByWebid($tablerow['webid']);
			 $tablerow['url'] = $url."/cars/show_{$tablerow['aid']}.html";;
			 $tablerow['title']=$tablerow['title'];
			

			 $tablerow['lit240'] = getUploadFileUrl(str_replace('litimg','lit240',$tablerow['litpic']));
			 $tablerow['lit160'] = getUploadFileUrl(str_replace('litimg','lit160',$tablerow['litpic']));
			 $tablerow['litpic'] = getUploadFileUrl($tablerow['litpic']);

             $real=getCarNewRealPrice($tablerow['aid'],$tablerow['webid']);

             $tablerow['minprice'] = $real ? $real : $tablerow['minprice'];
             $tablerow['sellprice'] = $real ? $real : 0;
             
			 $tablerow['price']=empty($tablerow['minprice'])?'电询':$tablerow['minprice'];
             $tablerow['price2']=empty($tablerow['minprice'])?'电询': '<span>&yen;</span><strong>'.$tablerow['minprice'].'</strong><i>起</i>';//目的地页面用
             if(is_array($dtp2->CTags))
			 {
					foreach($dtp2->CTags as $tagid=>$ctag)
					{
						if($ctag->GetName()=='array')
						{
							$dtp2->Assign($tagid, $tablerow);
						}
						else
						{
						  $value=empty($tablerow[$ctag->GetName()]) ? '' : $tablerow[$ctag->GetName()];
						
						  $dtp2->Assign($tagid,$value);
						}
					}
				}
			 $likeType.= $dtp2->GetResult();
         }
    }
	
    //Loop for $i
    $dsql->FreeResult();
	//print_r($likeType);
	return $likeType;
	

}
