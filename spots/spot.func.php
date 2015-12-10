<?php
require_once(dirname(__FILE__)."/../include/common.inc.php");

//获取攻略信息

function getSpotInfo($aid)
{
	global $dsql;
    $webid = $GLOBALS['sys_child_webid'];
    $sql="select a.* from #@__spot a  where a.aid=$aid and a.webid='$webid'";
    $row=$dsql->GetOne($sql);
	return $row;
	
}

function getPreNext($id)
    {
        global $dsql,$sys_webid;
		
		$aid=$id;
	    $info =array();
      
          
            $preRow =  $dsql->GetOne("Select aid,title,shownum From #@__spot where aid<$aid and webid=$sys_webid order by aid desc");
            $nextRow = $dsql->GetOne("Select aid,title,shownum From #@__spot where aid>$aid and webid=$sys_webid order by aid asc");

           
            if(is_array($preRow))
            {
                $url = $GLOBALS['cfg_cmsurl']."/spots/show_{$preRow['aid']}.html";
                $info['pre'] = "上一篇：<a href='$url'>{$preRow['title']}</a> <span class='color_hong'>{$row['shownum']}</span>";
               
            }
            else
            {
                $info['pre'] = "上一篇：没有了 ";
                
            }
            if(is_array($nextRow))
            {
                $url = $GLOBALS['cfg_cmsurl']."/spots/show_{$nextRow['aid']}.html";
                $info['next'] = "下一篇：<a href='$url'>{$nextRow['title']}<span class='color_hong'>{$row['shownum']}</span></a> <span class='color_hong'>{$row['shownum']}</span>";
            }
            else
            {
                $info['next'] = "下一篇：没有了 ";
               
            }
      
      
        return $info;
    }	

//分析处理图片,返回大图,小图数组
function getPiclistArr($piclist)
{

       $picarr=explode(',',$piclist);
       $biglist = $thumblist = array();
	   foreach($picarr as $value)
	   {  
			if(empty($value))
			{
			 continue;
			}
		   $temparr=explode('||',$value);
		     $biglist[] =array('url'=>getUploadFileUrl(str_replace('litimg','allimg',$temparr[0])),'title'=>$temparr[1]);//大图
		     $thumbpic=array('url'=>getUploadFileUrl(str_replace('litimg','lit160',$temparr[0])),'title'=>$temparr[1]);
		   //$biglist[] =array('big'=>getUploadFileUrl(str_replace('litimg','allimg',$temparr[0])));//大图 
		   //$thumbpic= array('thumb'=>getUploadFileUrl(str_replace('litimg','lit160',$temparr[0])));
		   $thumblist[] = $thumbpic;//小图
		 
		}
       //return array($biglist,$thumblist);
	   return array('big'=>$biglist,'thumb'=>$thumblist);
}

//获取显示模板
function getTemplet($spotid)
{
    Helper_Archive::loadModule('common');
	$_model = new CommonModule('#@__spot_ticket');
	$arr = $_model->getAll("spotid='$spotid'");
	$num = count($arr);
	$templet = $num > 0 ? 'spot_show_ticket.htm' : 'spot_show.htm';
	return $templet;
	
	
}

//获取景点属性	
function getSpotAttr($attrid,$groupname=0)
{
  global $dsql;
  if(empty($attrid)) return '';
  $aids=explode(',',$attrid);
  $list='';
  if(!empty($groupname))
  {
      $sql = "select id from sline_spot_attr where attrname like '%$groupname%' and pid = 0 limit 1";
      $row = $dsql->GetOne($sql);
      $groupid = $row['id'];
  }
  $w = $groupid ? "and pid = '$groupid'" : '';
  for($i=0;isset($aids[$i]);$i++)
  {
	  $sql="select attrname from #@__spot_attr where id=$aids[$i] {$w}";
	  $row=$dsql->GetOne($sql);
	  $list.="{$row['attrname']} ";
  }

  return $list;
	
	
} 
/**
 *  获得价格范围的最小.最大值
 *
 * @access    private
 * @return    arr
 */
function getSpotMinMaxprice($priceid)
{
	 
  global $dsql;
  $arr=array();
  $arr['min']='';
  $arr['max']='';
  $sql="select min,max from #@__spot_pricelist where id=$priceid";
  $row=$dsql->GetOne($sql);
  if(is_array($row))
  {
     $arr['min']=!empty($row['min'])?$row['min']:0;
	 $arr['max']=!empty($row['max'])?$row['max']:0;
  }
 
  return $arr;
}



/*----搜索页面------*/





	 
   