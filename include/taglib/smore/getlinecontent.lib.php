<?php
 if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 线路分类详细页调用标签
 *
 * @version        $Id: getlinecontent.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2011, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */
 


function lib_getlinecontent(&$ctag,&$refObj)
{
    global $dsql;
	$attlist="row|10,flag|";
	$webid=0;
	
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
	extract($ctag->CAttribute->Items, EXTR_SKIP);
    $sql="select columnname,chinesename from #@__line_content where webid=0 and isopen=1 and columnname!='booking' and columnname!='linespot' and columnname!='pinglun'  and columnname !='zuche' order by displayorder asc";

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

        $row['lineid'] = $refObj->Fields['id'];//线路

        $row['content'] = isset($refObj->Fields[$row['columnname']]) ? $refObj->Fields[$row['columnname']] : '';

        if($row['columnname']=="payment")
        {

            if(empty($refObj->Fields[$row['columnname']]))
            {

                $row['content']=$GLOBALS['cfg_payment'];
            }


        }
        else if($row['columnname']=='jieshao')
        {
          /*  if($refObj->Fields['isstyle']==1)
            {
                $row['content'] = isset($refObj->Fields['jieshao']) ? $refObj->Fields['jieshao'] : '';
            }
            else
            {
                $row['content'] = isset($refObj->Fields['id']) ? $refObj->Fields['id'] : '';
            }*/
            $row['content'] = $refObj->Fields['id'];
        }

       /* else if($row['columnname']=="jieshao")
        {
            $row['content']= $style == 1 ? $refObj->Fields['jieshao'] : $refObj->Fields['txtjieshao'];
        }*/


        if(empty($row['content'])) continue;


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
