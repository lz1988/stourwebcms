<?php
require_once(dirname(__FILE__) . "/../include/common.inc.php");
Helper_Archive::loadModule('common');
//获取相册信息
function getPhotoInfo($aid)
{
    global $dsql;
    $sql = "select a.*,b.attrname from #@__photo a left join #@__photo_attr b on a.attrid=b.aid where a.aid=$aid and a.webid='0'";
    $row = $dsql->GetOne($sql);

    return $row;

}

//获取相册图片数量
function getPhotoNum($aid)
{
    global $dsql;
    $sql = "select count(*) as num from #@__photo_picture where webid='0' and pid='$aid'";
    $count = $dsql->GetOne($sql);
    return $count;
}

function getPD($type, $pid)
{
    global $dsql;
    if ($type == 'pre')
    {
        $sql = "select max(id) as imgid from #@__photo_picture where pid='$pid' and webid='0'";
    }
    else if ($type == 'next')
    {
        $sql = "select min(id) as imgid from #@__photo_picture where pid='$pid' and webid='0'";
    }
    $row = $dsql->GetOne($sql);
    return $row['imgid'];
}

//获取前面图片个数
function getPreCount($imgid, $pid)
{
    global $dsql;
    $sql = "select count(*) as num from #@__photo_picture where id<$imgid and pid='$pid' and webid=0";
    $row = $dsql->GetOne($sql);
    $num = 3;
    if ($row['num'] < 2)
    {

        $num = $row['num'] != 0 ? 2 : 1;

    }
    return $num;

}

function getPinLun($postid, $webid)
{
    global $dsql;
    $sql = "select * from #@__allcomments where webid=$webid and postid=$postid and typeid=6 order by replydate desc limit 0,5";
    $res = $dsql->getAll($sql);
    $str = "<ul>";
    foreach ($res AS $row)
    {
        $str .= "<li><a href=\"#\" class=\"plname\">{$row['nickname']}</a><span>评论：</span><a href=\"#\" class=\"plcon\">{$row['replycontent']}</a></li>";

    }
    $str .= "</ul>";
    return $str;

}

function getPinLunNum($postid, $webid)
{
    global $dsql;
    $sql = "select count(*) as num from #@__allcomments where webid=$webid and postid='$postid' and typeid=6 order by replydate desc";
    $row = $dsql->GetOne($sql);
    return $row['num'];

}

/*------搜索页面------*/

//获取上级
function getParkind($id)
{
    global $dsql;
    $sql = "select id,kindname from #@__destinations where id='$id'";
    $pname = $dsql->GetOne($sql);
    if (is_array($pname))
    {
        $str = ' &raquo; <a href="' . $GLOBALS['cfg_cmsurl'] . '/' . $pname['id'] . '/photos/" rel="nofollow">' . $pname['kindname'] . '相册</a>';
    }
    else
    {
        $str = '';
    }
    return $str;
}

//获取相册属性名称
function getPhotoAttrName($id)
{
    global $dsql;
    $sql = "select attrname from #@__photo_attr where id=$id";
    $row = $dsql->GetOne($sql);
    if (is_array($row))
    {
        $flag = $row['attrname'];
    }
    return $flag;

}


/**
 *  获得线路条数和访问次数
 *
 * @access    private
 * @return    arr
 */


function getPhotoPage($count, $pageno, $pagesize, $params, $disnum = 5) //获取相册的分页类
{
    if ($count == 0) return '<div class="nht_box" style="height:200px;width:100%; text-align:center"><img style="margin-top:40px" src="/templets/smore/images/nodata.jpg"></div>';

    $page = ceil($count / $pagesize);

    $url = "/photos/";
    //参数

    //foreach($params as $k=>$v)
    //{
    //	if(!empty($v))
    //   	 $p_str.='&'.$k.'='.$v;
    //}
    $pinyin = Helper_Archive::getDestPinyin($params['dest_id']);
    $pinyin = empty($pinyin) ? 'all' : $pinyin;
    $url .= $pinyin;

    $attrid = empty($params['attrid']) ? 0 : $params['attrid'];
    $url .= '-' . $attrid;

    $str .= '<div id="page" class="page">
		   <div class="page_num">
			';


    //前一页按钮			
    if ($pageno <= 1) $str .= '<span class="unprev"></span>';
    else
    {
        $pre_pageno = $pageno - 1;
        $str .= "<a class='prev' href='{$url}-{$pre_pageno}'></a>";
    }


    //计算页起始页和结束页
    if ($page >= $disnum)
    {
        $pre_num = ceil(($disnum - 1) / 2);
        $next_num = floor(($disnum - 1) / 2);
        if ($pre_num >= $pageno)
        {
            $start_index = 1;
            $end_index = $disnum;
        }
        else
        {
            $start_index = $pageno - $pre_num;
            $end_index = $pageno + $next_num;
        }
        if ($end_index >= $page)
        {
            $start_index = $page - $disnum;
            $end_index = $page;
        }
    }
    else
    {
        $start_index = 1;
        $end_index = $page;
    }

    //前置省略页面
    if ($start_index > 1) $str .= '<span class="etc"></span>';


    $start_index = $start_index < 1 ? 1 : $start_index;
    //实现
    for ($i = $start_index; $i <= $end_index; $i++)
    {
        if ($pageno == $i)
        {
            $str .= "<span class='current'>$i</span>";
        }
        else
        {
            $burl = $i == 1 ? $url : $url . '-' . $i;
            $str .= "<a href='$burl'>&nbsp;{$i}&nbsp;</a>";
        }
    }

    //后置省略页面
    if ($end_index < $page) $str .= '<span class="etc"></span>';


    //下一页按钮
    if ($pageno == $page)
    {
        $str .= '<span class="unnext"></span>';
    }
    else
    {
        $next_pageno = ($pageno + 1) <= $page ? $pageno + 1 : $page;
        $str .= "<a href=\"{$url}-$next_pageno\" class=\"next\"></a>";
    }
    $str .= "</div></div>";
    return $str;
}

function getPhotoChildDest($destid, $flag = false)
{
    global $dsql;

    if ($flag)
    {
        $dest_arr = explode(',', $destid);
        sort($dest_arr);
        $destid = array_pop($dest_arr);
    }


    $destid = empty($destid) ? 0 : $destid;
    $sql = "select a.id,a.kindname from #@__destinations a left join #@__photo_kindlist b on a.id=b.kindid where a.isopen=1 and a.pid='$destid' order by b.displayorder";
    $result = $dsql->getAll($sql);

    if (empty($result))
    {
        $sql2 = "select pid from #@__destinations where id=$destid";
        $re = $dsql->GetOne($sql2);
        $sql = "select a.id,a.kindname from #@__destinations a left join #@__photo_kindlist b on a.id=b.kindid where a.isopen=1 and a.pid={$re['pid']} order by b.displayorder";
        $result = $dsql->getAll($sql);
    }
    return $result;
}

function  getPhotoMianbao($destid)
{
    $result = Helper_Archive::getParentDestNav($destid);
    foreach ($result as $k => $v)
    {
        $str .= ' &gt; <a href="/photos/index.php?dest_id=' . $v['id'] . '">' . $v['kindname'] . '</a>';
    }
    return $str;

}

//获取相册图片列表
function getPhotoPictures($id, $thumb = '')
{
    global $dsql;
    //$id_arr=$dsql->GetOne("select id from #@__photo where $aid=aid and webid=$webid");
    $result = $dsql->getAll("select * from #@__photo_picture where  pid='$id' order by id");


    foreach ($result as $k => $v)
    {
        $pic = !empty($thumb) ? str_replace('litimg', $thumb, $v['litpic']) : $v['litpic'];
        $result[$k]['pic'] = getUploadFileUrl($pic);
    }
    return $result;
}

function getPhotoSibling($aid, $webid, $tag = 0, $exclude = 0)
{
    global $dsql;

    $exclude = empty($exclude) ? 0 : $exclude;
    $cur_arr = $dsql->GetOne("select id from #@__photo where $aid=aid and webid=$webid");
    $dest_arr = explode(',', $cur_arr['kindlist']);
    rsort($dest_arr);
    foreach ($dest_arr as $k => $v)
    {
        if (empty($v)) continue;
        if ($tag == 0) $sql = "select * from #@__photo where find_in_set($v,kindlist) and ishidden=0 (aid<$aid) and aid!=$aid and webid=$webid and $aid!=$exclude  order by displayorder desc,id desc ";
        else
            $sql = "select * from #@__photo where find_in_set($v,kindlist) and ishidden=0 (aid>$aid) and aid!=$aid and webid=$webid and $aid!=$exclude  order by displayorder desc,id desc";
        $photo = $dsql->GetOne($sql);
        if (!empty($photo)) break;
    }
    if (empty($photo))
    {
        if ($tag == 0) $photo = $dsql->GetOne("select * from #@__photo where aid<$aid and aid!=$aid and aid!=$exclude order by aid desc");
        else
        {
            $photo = $dsql->GetOne("select * from #@__photo where aid>$aid and aid!=$aid and aid!=$exclude order  by aid asc");
        }
    }

    return $photo;
}


function getPhotoUrl($val = null, $key = null, $exclude = null)
{
    $arr = array('attrid');
    $url = "/photos/";
    $table = "#@__photo_attr";
    return Helper_Archive::getUrlStatic($val, $key, $exclude, $arr, $url, $table);
}

function getPhotoUrlCls($class, $key, $val = null, $grouppid = null, $table = "#@__photo_attr")
{
    return Helper_Archive::getParamUrlCls($class, $key, $val, $grouppid, $table);
}

function getPhotoDestInfo($destid)
{
    global $dsql;
    $sql = "select a.kindname as shortname,b.seotitle,b.description,b.keyword from #@__destinations as a left join #@__photo_kindlist b on a.id=b.kindid where a.id={$destid} and isopen='1'";


    $row = $dsql->GetOne($sql);


    if (empty($row['seotitle']))
    {
        $row['seotitle'] = !empty($seotitle) ? $seotitle : $row['shortname'];
    }
    if (empty($row['description']))
    {
        $row['description'] = !empty($description) ? $description : '';
    }

    return $row;
}


?>