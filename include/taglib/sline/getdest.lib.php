<?php
if(!defined('SLINEINC'))
{
    exit("Request Error!");
}
/**
 * 子站获取目的地标签
 *
 * @version        $Id: getdest.lib.php netman
 * @package        Stourweb.Taglib
 * @copyright      Copyright (c) 2007 - 2015, Stourweb, Inc.
 * @link           http://www.stourweb.com
 */

function lib_getdest(&$ctag,&$refObj)
{
    global $dsql,$outlist;
	include(SLINEDATA."/webinfo.php");
    $attlist="row|8,flag|0,limit|0,item|0,destid|";
    FillAttsDefault($ctag->CAttribute->Items,$attlist);
    extract($ctag->CAttribute->Items, EXTR_SKIP);
	//$destid = empty($destid) ? $GLOBALS['sys_destid'] : $destid;//如果未指定当前目的地id,则获取全局目的地id

	//if(empty($destid)) return '';
	
	$table_array=array(
        "line"=>"#@__line_kindlist",
        "hotel"=>"#@__hotel_kindlist",
        "car"=>"#@__car_kindlist",
        "article"=>"#@__article_kindlist",
        "spot" =>"#@__spot_kindlist",
        "photo"=>"#@__photo_kindlist",
        "tuan"=>"#@__tuan_kindlist"
    );
	
	
    $innertext = trim($ctag->GetInnertext());
    $revalue = '';
   
    $ctp = new STTagParse();
    $ctp->SetNameSpace("field","[","]");
    $ctp->LoadSource($innertext);
	$table = '#@__destinations';
	
	//获取目的地下级分类(未指定item时);
   if($item=='0')
   {		
	 if($flag == 'top')//顶级分类（国内、出境）
	 {
		 $sql="select a.* from {$table} a where a.pid = '0' and a.isopen=1 order by a.displayorder asc limit $limit,$row";
		 
	 }
	 if($flag=='next')
	  {
		  //$parentid = !empty($refObj->Fields['parentid']) ? $refObj->Fields['parentid'] : 0;
		  
		  //$parentid = empty($parentid) ? $refObj->Fields['kindid'] : $parentid;
          $parentid = $GLOBALS['sys_child_webid'];//当前级目的地id.

		  $sql="select a.* from {$table} a where a.pid = '$parentid' and a.isopen=1 order by a.displayorder asc limit $limit,$row";
		  
		  
		 
	  }
	  if($flag == 'hot')
	  {

	   	  $sql="select a.* from {$table} a where a.ishot = 1 and a.isopen = 1 order by a.displayorder asc limit $limit,$row";
	  }
      if($flag == 'mdd_hot')
      {

          $parentid = $GLOBALS['sys_child_webid'];//当前级目的地id.
          $child_list = array();
          getChildNode($parentid,$child_list);//获取子级
          $child_list_str = implode(',',$child_list);
          //if(!empty($child_list_str))
          {
              $where = " and id in ($child_list_str) ";
          }

       $sql="select a.* from {$table} a where a.ishot = 1 and a.isopen = 1 {$where} order by a.displayorder asc limit $limit,$row";


      }
   }
   else //指定item参数
   {
	   //普通排序
	  if($flag==0)
	  {
		   $sql="select a.kindname,a.id,a.pinyin from $table a left join {$table_array[$item]} b on a.id=b.kindid where a.isopen=1 order by b.displayorder,a.pinyin asc limit $limit,$row";
	  }
	  //热门排序 
	  if($flag == 'hot')
	  {
	   	  $sql="select a.kindname,a.id,a.pinyin from $table a left join {$table_array[$item]} b on a.id=b.kindid where b.ishot = 1  and a.isopen=1 order by b.ishot desc,b.displayorder,a.pinyin asc limit $limit,$row";
	  }
	  if($flag=='nav')
	  {
		  $sql="select a.kindname,a.id,a.pinyin,b.* from $table a left join {$table_array[$item]} b on a.id=b.kindid where b.isnav = 1  and a.isopen=1 order by b.isnav desc,b.displayorder,a.pinyin asc limit $limit,$row"; 
	  }
	  if($flag=='next')
	  {
		  $parentid = !empty($refObj->Fields['parentid']) ? $refObj->Fields['parentid'] : 0;
		  $parentid = empty($parentid) ? $refObj->Fields['kindid'] : $parentid;
		  $sql="select a.kindname,a.id,a.pinyin from $table a left join {$table_array[$item]} b on a.id=b.kindid where  a.isopen=1  and a.pid=$parentid order by b.isnav desc,b.displayorder,a.pinyin asc limit $limit,$row"; 
		  
	  }
       if($flag == 'mdd_hot')
       {

           $table = $table_array[$item];
           $parentid = $GLOBALS['sys_child_webid'];//当前级目的地id.
           $child_list = array();
           getChildNode($parentid,$child_list);//获取子级
           $child_list_str = implode(',',$child_list);
           $where = " and b.kindid in ($child_list_str) ";
           $sql="select a.* from #@__destinations a left join {$table} b on(a.id=b.kindid) where b.ishot = 1  {$where} order by b.displayorder asc limit $limit,$row";

       }

   }

	 $rows = null;
	
	 $rows=$dsql->getAll($sql);
	 $GLOBALS['autoindex']=0;



        foreach($rows as $row)
        {
            $GLOBALS['autoindex']++;
            $lit = explode('||',$row['litpic']);
            $litpic = $lit[0];
            $row['lit240']=getUploadFileUrl(str_replace('litimg','lit240',$litpic));//getPicByName($row['litpic'],'lit240');
            $row['lit160']=getUploadFileUrl(str_replace('litimg','lit160',$litpic));

            $row['litpic']=getUploadFileUrl($litpic);
            $row['kindid']=$row['id'];
            $row['title']=$row['kindname'];
            $row['pinyin'] =!empty($row['pinyin']) ? $row['pinyin'] : $row['id'];
            $desturl = GetWebURLByWebid(0);
            $row['url'] = $desturl.'/'.$row['pinyin'].'/';


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

//递归调用
//$child_list = array();
function getChildNode($rootid,&$child_list)
{
    global $dsql;

    $sql = "select id from #@__destinations where pid='$rootid' and isopen = '1' and isnav='0' ";


    $arr = $dsql->getAll($sql);

    foreach($arr as $row)
    {

        if(!empty($row['id']))
        {
            array_push($child_list,$row['id']);
            getChildNode($row['id'],$child_list);
        }

    }




}


