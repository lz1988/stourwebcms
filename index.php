<?php
if (!file_exists(dirname(__FILE__) . '/data/common.inc.php'))
{
    header('Location:install/index.php');
    exit();
}

require_once(dirname(__FILE__) . "/include/common.inc.php");

$html = dirname(__FILE__) . '/index.html';
$child_html = SLINEDATA . '/html/child/' . $GLOBALS['sys_webprefix'] . '_' . 'index.html';
if (file_exists($html) && $genpage != 1 && $GLOBALS['sys_child_webid'] == 0)
{
    include($html); //载入主站首页
    exit;
}
else if (file_exists($child_html) && $genpage != 1 && $GLOBALS['sys_child_webid'] != 0)
{
    include($child_html); //载入子站首页
    exit;
}
else
{
    require_once SLINEINC . "/view.class.php";

    $pv = new View();
    $temp_num = $dsql->GetOne("select count(*) as num from #@__member_order");
    $pv->GetChannelKeywords(0);
    $pv->Fields['sellnum'] = $temp_num['num'];
    $templet = Helper_Archive::getUseTemplet('index'); //获取首页使用模板(根据当前域名自动判断是主站还是子站)
    if (!$GLOBALS['sys_child_webid'])
    {
        $indextemplet = $GLOBALS['cfg_index_templet'] ? $GLOBALS['cfg_index_templet'] : 'index_1.htm';
        $templet = !empty($templet) ? $templet : SLINETEMPLATE . "/" . $cfg_df_style . "/index/" . $indextemplet; //主站默认模板
    }
    else
    {
        $templet = !empty($templet) ? $templet : SLINETEMPLATE . "/" . $cfg_childsite_style . "/" . "index.htm"; //子站默认模板
    }
    $pv->SetTemplet($templet);
    $pv->Display();
}


?>