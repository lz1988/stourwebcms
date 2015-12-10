<?php 
require_once(dirname(__FILE__)."/../include/common.inc.php");
require_once(dirname(__FILE__)."/article.func.php");
$typeid=4; //文章栏目
require_once SLINEINC."/view.class.php";
$pv = new View($typeid);
if(!isset($aid)) exit('Wrong Id');
$aid=RemoveXSS($aid);//防止跨站攻击
updateVisit($aid,$typeid);//更新访问次数
$row = getArticleInfo($aid);

if(empty($row['id']))
{
  head404();
}
if(!empty($row['redirecturl']))
{
    head301($row['redirecturl']);
}
$prenext=GetPreNext($aid);//获取上一条,下一条
foreach($prenext as $k=>$v)
{
   $pv->Fields[$k] = $v;
}

if(is_array($row))
{
    $row['litpic']=!empty($row['litpic'])? $row['litpic']:getDefaultImage();
    $row['taglook']=GetTagsLink($row['tagword']);
    $row['description']=!empty($row['description'])?"<meta name=\"description\" content=\"".$row['description']."\"/>":"";
    $row['keyword']=!empty($row['keyword'])?"<meta name=\"keywords\" content=\"".$row['keyword']."\"/>":"";
    $row['subname']=$row['title'];
	
	$row['commentnum']=Helper_Archive::getCommentNum($row['id'],4);
	$row['commenthomeid']=$row['id'];
    $row['id']=strlen($row['id'])==1?"0".$row['id']:$row['id'];
	$row['pkname'] = get_par_value($row['kindlist'],$typeid);
	$row['yesjian']=is_null($row['yesjian'])? 0 : $row['yesjian'];
	
	$row['destid']=array_remove_value($row['kindlist']);
	
	$row['pinyin']=Helper_Archive::getDestPinyin($row['destid']);
	$row['destname']=!empty($row['destid'])?'[<a href="/raiders/'.$row['pinyin'].'">'.Helper_Archive::getBelongDestName($row['kindlist']).'</a>]':'';//所属目的地
	$row['destarcnum']=getArticleNum($row['destid']);
	$row['attrlist']=getArticleAttrlist($row['attrid']);
	$row['summary']=empty($row['summary']) ? cutstr_html($row['content'],140) : $row['summary'];
	$row['kindid']=$row['destid'];
	$row['dest_html']=!empty($row['destid'])?"<div class=\"page_top\">"."<a href=\"/raiders/{$row['pinyin']}\">".Helper_Archive::getBelongDestName($row['kindlist'])."</a><span>旅游攻略</span>共{$row['destarcnum']}篇</div>":'';

    //是否设置了目的地条件,便于展示推荐线路
    if(!empty($row['destid']))
    {
        $GLOBALS['condition']['_hasdest']=1;
    }
    foreach($row as $k=>$v)
    {
	   $pv->Fields[$k] = $v;
    }
}
 //获取上级开启了导航的目的地
getTopNavDest($row['kindlist']);
$typename=GetTypeName($typeid);//获取栏目名称.
$pv->Fields['typename'] = $typename;
$pv->Fields['title']=$row['title'];
$pv->Fields['seotitle']=$row['seotitle'];
$pv->Fields['addtime']=empty($row['modtime'])?$row['addtime']:$row['modtime'];
$templets = $row['templet'];
if(strpos($templets,'uploadtemplets')!==false)
{
    $templet = SLINETEMPLATE.'/smore/'.$templets.'/index.htm';//使用自定义模板
}
else
{
    if($row['templet']=='moban2')
    {
        $templet = SLINETEMPLATE ."/".$cfg_df_style ."/" ."raiders/" ."article_gf_show.htm";//系统标准模板
        $picturelist = GfArticle::handlepicture($row['piclist']);
        if(!empty($row['attachment']))
        {
            $GLOBALS['condition']['_hasattachment']=1;
        }
        $out = GfArticle::handleContent($row['content']);
        $directory = GfArticle::genDirectory($out['directory']);
        $content = $out['content'];
        $pv->Fields['content'] = $content;
        $pv->Fields['directory'] = $directory;

    }
    else
    {
        $templet = SLINETEMPLATE ."/".$cfg_df_style ."/" ."raiders/" ."article_show.htm";//系统标准模板
    }

}


$pv->SetTemplet($templet);
$pv->Display();
exit();

Class GfArticle{
    //处理图片
    public static function handlepicture($piclist)
    {
        $out = array();
        $picarr = explode(',',$piclist);
        foreach($picarr as $pic)
        {
            $p = explode('||',$pic);
            $picture = str_replace('litimg','allimg',$p[0]);
            $title = $p[1] ? $p[1] : '';
            $out[]=array('title'=>$title,'litpic'=>$picture);
        }
        return $out;

    }
    //处理内容
    public static function handleContent($content)
    {

        $ar = explode("<stkind>",trim($content));
        unset($ar[0]);

        $out = array();
        $id = 1;
        foreach($ar as $row)
        {
            //提取目录名称
            $pattern = '/(.*?)\<\/stkind>/is';
            preg_match($pattern,$row,$match);

            //提取子标题
            $pattern= "/\<sttitle\>(.*?)\<\/sttitle\>/";
            preg_match_all($pattern,$row,$match2);
            $subtitle = $match2[1];
            $stitle_arr = array();
            $k = $id+1;
            foreach($subtitle as $stitle)
            {
                 $stitle_arr[]=array('id'=>$k,'title'=>$stitle);
                 $k++;
            }

            $arr = array('kindname'=>array('id'=>$id,'title'=>$match[1]),'subname'=>$stitle_arr);
            $id = $k;
            $out[]=$arr;


        }


        //替换

        foreach($out as $row)
        {
            $find = "<div style=\"font-size:14px;font-weight:bold\"><stkind>{$row['kindname']['title']}</stkind></div>";
            $replace = "<div class=\"gf_kind\" id=\"kind_{$row['kindname']['id']}\">{$row['kindname']['title']}</div>";
            $content = str_replace($find,$replace,$content);//替换分类

            foreach($row['subname'] as $v)
            {
                $find = "<div style=\"font-size: 12px;font-weight: bold\"><sttitle>{$v['title']}</sttitle></div>";
                $replace = "<div class=\"gf_title\" id=\"kind_title_{$v['id']}\">{$v['title']}</div>";
                $content = str_replace($find,$replace,$content);//替换分类


            }


        }

        return array('content'=>$content,'directory'=>$out);
    }


    //生成目录
    public static function genDirectory($directory)
    {
        $out = '';
        foreach($directory as $dir)
        {
           $out.="<dl>";
           $out.="<dt><a href=\"#kind_{$dir['kindname']['id']}\">{$dir['kindname']['title']}</dt>";
           foreach($dir['subname'] as $sub)
           {
               $out.="<dd><a href=\"#kind_title_{$sub['id']}\">{$sub['title']}</a></dd>";
           }
           $out.="</dl>";
        }
        return $out;

    }

}

	 
?>
