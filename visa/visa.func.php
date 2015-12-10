<?php 


function getAreaName($id)
{
	global $dsql;
	$sql="select kindname from #@__visa_area where id='$id'";
	$row=$dsql->GetOne($sql);
	return $row['kindname'];	
	
}

/*
 * 获取国家信息
 * */
function getNationInfo($pinyin)
{
    global $dsql;
    $sql = "select * from sline_visa_area where pinyin='$pinyin'";
    $row = $dsql->GetOne($sql);
    return $row;
}

function GetPreNext($id)
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
	
function getVisaType($id)
{
  	global $dsql;
	$sql="select kindname from #@__visa_kind where id='$id'";
	$row=$dsql->GetOne($sql);
	return $row['kindname'];
}
function getVisaCity($id)
{
  	global $dsql;
	$sql="select kindname from #@__visa_city where id='$id'";
	$row=$dsql->GetOne($sql);
	return $row['kindname'];
}

function getVisaInfo($aid)
{
	global $dsql;
	$sql="select * from #@__visa where aid=$aid";
	$row=$dsql->GetOne($sql);
	return $row;
}

function getidByName($country)
{
   global $dsql;
   $sql="select id from #@__visa_area where kindname like '%$country%'";
   $row=$dsql->GetOne($sql);
   return $row['id'];
	
	
}
function getVisaUrl($aid)
{
  return "{$GLOBALS['cfg_cmsurl']}/visa/show_{$aid}.html";	
}

function getNeed($aid)
{
	$out=$aid==1 ? '需要' :'不需要';
    return $out;
	
}

//获取首页广告
function getVisaTopAd()
{
    global $dsql;
    $sql = "select picurl from sline_advertise where tagname='visatopad'";
    $row = $dsql->GetOne($sql);
    return !empty($row['picurl']) ? $row['picurl'] : '/templets/smore/images/visa_index_bg.jpg';

}

Class VisaFunc{

    public static function getVisaContent($row)
    {
        global $dsql;
        if($row['columnname']=='material')//资料模块特殊处理
        {
            $sql = "select material,material2,material3,material4,material5 from sline_visa where id='{$row['productid']}'";
            $row = $dsql->GetOne($sql);
            $out='  <div class="visa-box">
                   <dl id="switchBox">
                      <dt>
                          <span class="on" data-id="m1">在职人员</span>
                          <span data-id="m2">自由职业</span>
                          <span data-id="m3">退休人员</span>
                          <span data-id="m4">学生</span>
                          <span data-id="m5">学龄前儿童</span>
                      </dt>
                      <dd id="m1">
                          '.$row['material'].'
                      </dd>
                      <dd id="m2">
                          '.$row['material2'].'
                      </dd>
                      <dd id="m3">
                          '.$row['material3'].'
                      </dd>
                      <dd id="m4">
                          '.$row['material4'].'
                      </dd>
                      <dd id="m5">
                          '.$row['material5'].'
                      </dd>
                  </dl>
                  </div>';

            return $out;


        }
        else
        {
            return $row['content'];
        }

    }

}



?>