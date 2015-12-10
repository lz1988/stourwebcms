<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 线路左侧滑动导航标签(与leftnav配合使用)
 *
 * @version        $Id: getleftnav.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2014, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

function lib_getleftnav(&$ctag,&$refObj)
{
    global $dsql;
	
    $attlist="row|8,";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
    $pid=$refObj->Fields['kindid']; //上级导航
    $innertext = trim($ctag->GetInnertext());
	$table = "#@__destinations";
    $revalue = '';
	
	$sql="select id,kindname,pinyin from {$table} where pid='{$pid}' and isopen=1 order by displayorder asc";
	
	$arr=$dsql->getAll($sql);
	
	$GLOBALS['autoindex']=0;
	
	 
	for($i=0;isset($arr[$i]);$i++)
	{
        $GLOBALS['autoindex']++;
		$row=$arr[$i];
        $hotdest = getHotDest($row['id']);
		
		$row['categoryname'] = $arr[$i]['kindname'];
	    $row['categorychild4']=getCategoryChild($row['id']);//左侧显示的内容
		$row['childleft'] = getHoverHtml($row['id']); //指向弹出的内容

        $row['childpre'] = $hotdest[0];
        $row['childnextall'] = $hotdest[1];

        $row['childall'] = getCategoryChildAll($row['id']);//全部子级,右侧模块用
        $row['youwanshijian'] = getYwTime($row['id']);//获取游玩时间
        $row['shuxin'] = getShuXin($row['id']);//获取属性.
        $row['jiage'] = getJiaGe($row['id']);//获取价格
        $row['tjxianlu'] = getTjXianlu($row['id']);//获取推荐线路
        $row['pinyin'] = !empty($row['pinyin']) ? $row['pinyin'] : $row['id'];

		
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
function getCategoryChild($kindid,$dothree=1)
{
	 global $dsql;
	 $table = "#@__destinations";
	 $outlist='';
	 $w = $dothree == 1 ? "limit 0,4" : "limit 4,100";
	 $sql="select id,kindname,pinyin from {$table} where pid='$kindid' and isopen='1'  order by displayorder asc {$w}";

	 $arr=$dsql->getAll($sql);
  
	 for($i=0;isset($arr[$i]);$i++)
	  {
		    $row=$arr[$i];
            $pinyin = !empty($row['pinyin']) ? $row['pinyin'] : $row['id'];
			$url = $GLOBALS['cfg_basehost'].'/lines/'.$pinyin.'/';
			if($dothree == 1)
			{
				$outlist.="<a class=\"attr_fl\" href=\"{$url}\">{$row['kindname']}</a>";
				
			}
			else
			{
	          
	          $outlist.="<a href=\"{$url}\" target=\"_blank\"  rel=\"nofollow\">{$row['kindname']}</a>";
			}
	  }
	  return $outlist;

	
}
//获取滑动出导航时的html
function getHoverHtml($kindid)
{
	global $dsql;
	$sql="select id,kindname from #@__destinations where pid='$kindid' and isopen='1'  order by displayorder asc";
	$arr = $dsql->getAll($sql);
	foreach($arr as $row)
	{
		//$url = $GLBOALS['cfg_basehost'].'/lines/search.php?dest_id='.$row['id'];
		/*$out.='<div class="subitem">
                <dl class="fore1">';
		$out.='<dt><a href="'.$url.'" target="_blank">'.$row['kindname'].'</a></dt>';
		$out.='<dd>'.getCategoryChild($row['id'],0).'<dd>';
		$out.=' </dl> </div>';*/

        $out.=getCategoryChild($row['id'],0);
	}
	  
	return $out;
	
}

//获取子级全部
function getCategoryChildAll($kindid)
{
    global $dsql;
    $table = "#@__destinations";
    $outlist='';

    $sql="select id,kindname,pinyin from {$table} where pid='$kindid' and isopen='1'  order by displayorder asc {$w}";

    $arr=$dsql->getAll($sql);
    foreach($arr as $row)
    {
        $url = $GLOBALS['cfg_basehost'].'/'.$row['pinyin'].'/';
        $outlist.="<a  href=\"{$url}\" target=\"_blank\">{$row['kindname']}</a>";
    }
    return $outlist;


}
//获取游玩时间

function getYwTime($destid)
{
    global $dsql;
    $sql="select id,word from #@__line_day  where webid=0 order by word asc";
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $number=substr($row['word'],0,2);
        $arr=array("零","一","二","三","四","五","六","七","八","九");
        if(strlen($number)==1)
        {
            $result=$arr[$number];
        }
        else
        {
            if($number==10)
            {
                $result="十";
            }
            else
            {
                if($number<20)
                {
                    $result="十";
                }
                else
                {
                    $result=$arr[substr($number,0,1)]."十";
                }
                if(substr($number,1,1)!="0")
                {
                    $result.=$arr[substr($number,1,1)];
                }
            }
        }

            if($GLOBALS['autoindex']==$rowcount)
            {
                $title=$result."日游以上";
            }
            else
            {
                $title=$result."日游";
            }
           $pinyin = Helper_Archive::getDestPinyin($destid);
           $pinyin = !empty($pinyin) ? $pinyin : $destid;
            $row['url']="{$GLOBALS['cfg_cmsurl']}/lines/".$pinyin."-{$row['word']}-0-0-0-0";
            $out.='<a href="'.$row['url'].'" target="_blank">'.$title.'</a>';

    }
    return $out;
}

//获取属性组列表
function getShuXin($destid)
{
    global $dsql;
    $sql="select id,attrname as groupname from #@__line_attr where webid=0 and pid=0 and isopen=1 order by displayorder asc limit 0,2" ;
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
       $out.='<dl class="sx_dl">
                    	<dt>'.$row['groupname'].'：</dt>
                      <dd>
                      '.getShuXinByPid($row['id'],$destid).'
                      </dd>
                    </dl>';
    }
    return $out;
}

function getShuXinByPid($pid,$destid)
{
    global $dsql;
    $sql="select id,attrname from #@__line_attr where pid ='$pid' and isopen=1 order by displayorder asc";
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $pinyin = Helper_Archive::getDestPinyin($destid);
        $pinyin = !empty($pinyin) ? $pinyin : $destid;
        //$url = $GLOBALS['cfg_basehost'].'/lines/'.$pinyin.'/';
        $url = $GLOBALS['cfg_cmsurl'].'/lines/'.$pinyin.'-0-0-0-0-'.$row['id'];
        $out.= '<a href="'.$url.'" target="_blank">'.$row['attrname'].'</a>';
    }
    return $out;
}

//获取价格
function getJiaGe($destid)
{
    global $dsql;
    $sql="select id,aid,lowerprice as min,highprice as max from #@__line_pricelist where webid=0 order by min";
    $arr = $dsql->getAll($sql);
    foreach($arr as $row)
    {
        $pinyin = Helper_Archive::getDestPinyin($destid);
        $pinyin = !empty($pinyin) ? $pinyin : $destid;
        //$url = $GLOBALS['cfg_basehost'].'/lines/'.$pinyin.'/';
        $url = $GLOBALS['cfg_cmsurl'].'/lines/'.$pinyin.'-0-'.$row['aid'].'-0-0-0';
        //$url = $GLOBALS['cfg_cmsurl'].'/lines/search.php?dest_id='.$destid.'&priceid='.$row['aid'];
        if($row['min']!=''&& $row['max']!='' && $row['min']!=0)
        {
            $row['title']=$row['min'].'~'.$row['max'].'';
        }
        else if($row['min']=='' || $row['min']==0)
        {
            $row['title']=$row['max'].'以下';
        }
        else if($row['max']=='')
        {
            $row['title']=$row['min'].'以上';
        }
        $out.='<a href="'.$url.'" target="_blank">'.$row['title'].'</a>';
    }
    return $out;
}

//获取推荐线路
function getTjXianlu($destid)
{
   require_once(SLINEINC.'/view.class.php');
    $out = '';
   $innertext ='  {sline:getlinelist type="mdd" flag="recommend" row="2"}
                              <dl>
                                  <dt>
                                      <a class="fl" href="[field:url/]" target="_blank"><img class="fl" src="[field:lit160/]" width="90" height="70" alt="[field:title/]" title="[field:title/]" /></a>
                                  <h4><a href="[field:url/]" target="_blank">[field:title/]</a></h4>
                                  <p><b>[field:price2/]</b><label>满意度：<span class="color_f60">[field:satisfyscore/]</span></label><label>预订量：<span class="color_f60">[field:sellnum/]</span></label></p>
                                  </dt>
                                  <dd><span class="color_f60">产品特点：</span>[field:sellpoint/]</dd>
                              </dl>
                              {/sline:getlinelist}';
    $pv = new View(0);

    $pv->Fields['kindid']=$destid;

    $pv->SetTemplet($innertext,'string');
    $out = $pv->GetResult();

    return $out;


}




//获取相应目的地下所有热门目的地

function getHotDest($destid)
{
    global $dsql;
    $childlist = array();
    getChildNode2($destid,$childlist);//获取所有子目的地
    $childids = implode(',',$childlist);

    $sql = "select a.id,a.kindname,a.pinyin from #@__destinations a left join #@__line_kindlist b on(a.id = b.kindid) where a.id in ($childids) and b.ishot = 1 order by b.displayorder asc";

    $arr = $dsql->getAll($sql);
    $k = 1;
    foreach($arr as $row)
    {
        $pinyin = !empty($row['pinyin']) ? $row['pinyin'] : $row['id'];
        //$url = $GLOBALS['cfg_basehost'].'/lines/search.php?dest_id='.$row['id'];
        $url = $GLOBALS['cfg_basehost'].'/lines/'.$pinyin.'/';
        if($k < 4)
        {
            $four .= "<a class=\"attr_fl\" href=\"{$url}\" target=\"_blank\"  rel=\"nofollow\">{$row['kindname']}</a>";
        }
        else
        {
            $left .= "<a href=\"{$url}\" target=\"_blank\"  rel=\"nofollow\">{$row['kindname']}</a>";
        }
        $k++;
    }
    return array($four,$left);
}
//递归调用
//$child_list = array();
function getChildNode2($rootid,&$child_list)
{
    global $dsql;

    $sql = "select id from #@__destinations where pid='$rootid' and isopen = '1' ";

    $arr = $dsql->getAll($sql);

    foreach($arr as $row)
    {

        if(!empty($row['id']))
        {
            array_push($child_list,$row['id']);
            getChildNode2($row['id'],$child_list);
        }



    }

}
