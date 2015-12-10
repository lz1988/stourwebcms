<?php 
@session_start();
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/../data/webinfo.php");
/*
 *listid  URL栏目的typeid
 *tag     tag词语
 */
$typeid=4; //景点栏目


$lanmu=array(
						'1'=>'lines',
						'2'=>'hotel',
						'3'=>'car',
						'4'=>'article',
						'5'=>'spot',
						'6'=>'photo',
						'7'=>'leave'
				);
$name=array( 
					    '1'=>'title',
					    '2'=>'title',
					    '3'=>'title',
					    '4'=>'title',
					    '5'=>'title',
					    '6'=>'title',
						'7'=>'title'
						 
	                 );
	$url=array(
					'1'=>'/lines/',
					'2'=>'/hotels/',
					'3'=>'/cars/',
					'4'=>'/raiders/',
					'5'=>'/spots/',
					'6'=>'/photos/',
					'7'=>'/questions/'
			   );
    $truename=array(
					'1'=>'线路',
					'2'=>'酒店',
					'3'=>'车务',
					'4'=>'文章',
					'5'=>'景点',
					'6'=>'相册',
					'7'=>'问答'
			   );
	$tag=RemoveXSS($tag);//防止跨站攻击
	
	$sql="select tagname from #@__tmptag where id='$tag' and webid='0'";
	$row=$dsql->GetOne($sql);
	$tagword=$row['tagname'];
	
	$alllist['tag']=$tag;
	if($tagword!="")
	{
	   $alllist['seotitle']=$tagword."相关信息";
	   $alllist['tagname']=$tagword."相关信息";
	 }
	else
	{
	  $alllist['seotitle']="查询不到相关内容";
	  $alllist['tagname']="<span style='color:red;'>查找不出相关的tag信息</span>";
    }
	//listid为栏目typeid
	if(isset($listid)&&$listid!=0)

	  {      
		       $listid=RemoveXSS($listid);//防止跨站攻击
			   $pv = new View($typeid);
		       require_once SLINEINC."/listview.class.php";
			   $sql="select shortname from #@__nav where typeid={$listid} and webid=0";
			   $row=$dsql->GetOne($sql);
			   $alllist['seotitle']=$tagword."-".$row['shortname']."相关信息";
			   if($listid==10){$listid=7;}
		       $article="";
			   if(!$tagword=="")
			   {
				   $where=" where webid=0 and tagword like '%$tagword%'";
				   $listid=$listid!='10'?$listid:7;
				   $sql="select {$name[$listid]} as name,aid from #@__{$lanmu[$listid]}  $where order by aid desc";
				   $dsql->SetQuery($sql);
				   $dsql->Execute();
				   $listnum=0;
				   while($row=$dsql->GetArray())
					   {
						 $listnum++;
						 $row['name']=cutword($row['name'],20);
                         $row['name']=str_replace($tagword,"<span style='color:red;'>".$tagword."</span>",$row['name']);
						 $article.=" <dd><a href='{$url[$listid]}show_{$row['aid']}.html'>{$row['name']}</a></dd>";
					   }
				   $alllist['showall']=$article;
			   }
			   $alllist['type']=$truename[$listid];

			   $alllist['num']="当前显示 ".$tagword." 相关信息{$listnum}条";
			   if(is_array($alllist))
				  {
						 //$row['taglook']=GetTagsLink($row['tagword']);
						 foreach($alllist as $k=>$v)
						{
							$pv->Fields[$k] = $v;
						}
				  }
			   //$pv->pagesize=10;//分页条数.
               //$pv->SetSql($sql);
		       $pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."raiders/" ."showarctaglist.htm");
               $pv->Display(); 
		       exit;
	   }
	       $pv = new View($typeid);
           $num=count($lanmu);
		   $listnum="0";
		  for($i=1;$i<=$num;$i++)
		   {
			   $limit=6;  //显示条数
			   $article="";
			   if(!$tagword=="")
			   {
				   $where=" where webid=$sys_webid and tagword like '%$tagword%'";
				   $sql="select {$name[$i]} as name,aid from #@__{$lanmu[$i]}  $where order by aid desc limit 0,$limit";
				   $dsql->SetQuery($sql);
				   $dsql->Execute();
				   while($row=$dsql->GetArray())
					   {
						  $listnum++;
                          $row['name']=cutword($row['name'],20);
                          $row['name']=str_replace($tagword,"<span style='color:red;'>".$tagword."</span>",$row['name']);
						  $article.=" <dd><a href='{$url[$i]}show_{$row['aid']}.html'>{$row['name']}</a></dd>";
					   }
				}
			   $alllist['num']="当前显示 ".$tagword." 相关信息{$listnum}条";
			   $alllist[$lanmu[$i]]=$article;
			   $alllist[$lanmu[$i]."url"]="arctag_{$tag}_{$i}.html";
            }
			 
			  
			   
if(is_array($alllist))
		  {
		     //$row['taglook']=GetTagsLink($row['tagword']);
		     foreach($alllist as $k=>$v)
            {
                $pv->Fields[$k] = $v;
            }
		  }
$pv->SetTemplet(SLINETEMPLATE ."/".$cfg_df_style ."/" ."raiders/" ."arctaglist.htm");

$pv->Display();
   

?>
