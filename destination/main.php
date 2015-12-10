<?php
/*-----目的地页面-----*/
require_once(dirname(__FILE__) . "/../include/common.inc.php");
require_once(dirname(__FILE__) . "/dest.func.php");
require_once SLINEINC . "/view.class.php";
$file = SLINEDATA . "/autotitle.cache.inc.php"; //载入智能title配置
if (file_exists($file)) require_once($file);
$typeid = 12;
//兼容以前老地址,如果使用以前老地址访问则301跳转到新的地址
if (preg_match("/^\d*$/", $destid)) {
    $py = getPinyinById($destid);
    if (!empty($py)) {
        $url = $GLOBALS['cfg_basehost'] . '/' . $py . '/';
        head301($url);
    } else {
        head404();
    }

}

$pv = new View($typeid);
$destpy = $destid; //拼音赋值
$kindid = $destid = getDestIdByPy($destid); //获取目的地ID
$seoarr = getSeo($kindid); //获取关键词,描述,介绍等信息.
if($seoarr['iswebsite']==1)//判断当前目的地是否开启了子站.
{
    $url = $seoarr['weburl'];
    head301($url);
}

$html_file = SLINEDATA . '/dest/' . $kindid . '.html';
if (file_exists($html_file)) {
    if (time() - filemtime($html_file) < 3600) {
        include($html_file);
        exit;
    }
}
if (empty($kindid)) //如果不存在,则跳转到404
{
    head404();
    exit;
}

getTopNavDest($destid); //目的地导航信息



if (empty($seoarr['seotitle'])) //优化标题
{
    $seotitle = str_replace('XXX', $seoarr['kindname'], $cfg_dest_title);
    $seoarr['seotitle'] = empty($seotitle) ? $seoarr['kindname'] : $seotitle;


}
if (empty($seoarr['description'])) //优化描述
{
    $description = str_replace('XXX', $seoarr['kindname'], $cfg_dest_desc);
    $seoarr['seodescription'] = empty($description) ? '' : "<meta name=\"description\" content=\"" . $description . "\"/>";;

} else {
    $seoarr['seodescription'] = "<meta name=\"description\" content=\"" . $seoarr['description'] . "\"/>";
}
$seoarr['seokeyword'] = !empty($seoarr['keyword']) ? "<meta name=\"keywords\" content=\"" . $seoarr['keyword'] . "\"/>" : "";


//各栏目数量
$seoarr['linenum'] = getChannelCount(1, $kindid);
$seoarr['hotelnum'] = getChannelCount(2, $kindid);
$seoarr['carnum'] = getChannelCount(3, $kindid);
$seoarr['raidernum'] = getChannelCount(4, $kindid);
$seoarr['spotnum'] = getChannelCount(5, $kindid);
$seoarr['photonum'] = getChannelCount(6, $kindid);
//$seoarr['asknum']=getChannelCount(10,$kindid);

if (empty($seoarr['templetpath'])) //如果使用标准模板
{

    //是否显示条件.
    if ($seoarr['linenum'])
        $GLOBALS['condition']['_hasline'] = 1;
    if ($seoarr['hotelnum'])
        $GLOBALS['condition']['_hashotel'] = 1;
    if ($seoarr['carnum'])
        $GLOBALS['condition']['_hascar'] = 1;
    if ($seoarr['raidernum'])
        $GLOBALS['condition']['_hasraider'] = 1;
    if ($seoarr['spotnum'])
        $GLOBALS['condition']['_hasspot'] = 1;
    if ($seoarr['photonum'])
        $GLOBALS['condition']['_hasphoto'] = 1;


}

//父级
$parentname = '';
$parenturl = '';
$seoarr['pkname'] = getParkind($kindid);
$seoarr['typename'] = GetTypeName($typeid);
$pv->Fields['parentname'] = $parentname;
$pv->Fields['parenturl'] = $parenturl;

//seo变量赋值
foreach ($seoarr as $k => $v) {
    $pv->Fields[$k] = $v;
}

$pv->Fields['piclist'] = getPiclistArr($kindid, 725, 304);
$pv->Fields['kindid'] = $kindid;
$pv->Fields['destid'] = $destid;

//目的地相关产品数量
$dest_nums = getDestNumCache($kindid);

$total_visit = get_visit_count($dest_nums);
//模板赋值
foreach ($dest_nums as $k => $v) {
    $pv->Fields[$k] = $v;
}
$pv->Fields['total_visit'] = $total_visit;

if (!empty($seoarr['templetpath'])) {
    $funcfile = SLINETEMPLATE . "/" . $cfg_df_style . "/destination/destination/" . $seoarr['templetpath'] . "/function.php"; //引入自定模板函数文件

    if (file_exists($funcfile)) {
        include_once($funcfile);

    }
}
$templet = !empty($seoarr['templetpath']) ? "destination/{$seoarr['templetpath']}/index.htm" : 'main.htm'; //针对不同目的地模板.

$templets = $seoarr['templetpath'];

if(strpos($templets,'uploadtemplets')!==false)
{
    $templet = SLINETEMPLATE.'/smore/'.$templets.'/index.htm';//使用自定义模板
}
else
{
    $templet = Helper_Archive::getUseTemplet('dest_index');//获取系统默认使用模板

    $templet = !empty($templet) ? $templet : SLINETEMPLATE . "/" . $cfg_df_style . "/" . "destination/main.htm";
}

$pv->SetTemplet($templet);

$html_str = $pv->getResult();
file_put_contents($html_file, $html_str);//缓存当前文件.

$pv->Display();

exit();


function getPiclistArrZ($kindid,$bigtemp='<img src="{src}" width="725" height="304"/>',$replacetemp='{src}')
{
  global $dsql;
    $flag=0;
    $sql="select litpic,piclist from #@__destinations where id=$kindid";

    $row=$dsql->GetOne($sql);

    if(empty($row['litpic']) && empty($row['piclist']))
    {
        $df_big = getDefaultImage();
        $out = str_replace($replacetemp,$df_big,$bigtemp);
    }
    else if(!empty($row['litpic']) && empty($row['piclist']))
    {

        $temp_arr=explode('||',str_replace('litimg','allimg',$row['litpic']));
        $out = str_replace($replacetemp,$temp_arr[0],$bigtemp);
    }
    if(!empty($row['piclist']))
    {
        $picarr=explode(',',$row['piclist']);
        foreach($picarr as $key=>$value)
        {
            $temp_arr=explode('||',$value);

            $pic = str_replace('litimg','allimg',$temp_arr[0]);
            $out.=str_replace($replacetemp,$pic,$bigtemp);
        }
    }
    return $out;
}

?>