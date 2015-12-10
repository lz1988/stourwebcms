<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Search extends Stourweb_Controller{
    public static $typeArr=array(
        array('typeid'=>1,'channelname'=>'线路'),
        array('typeid'=>2,'channelname'=>'酒店'),
        array('typeid'=>3,'channelname'=>'车辆'),
        array('typeid'=>4,'channelname'=>'攻略'),
        array('typeid'=>5,'channelname'=>'门票'),
        array('typeid'=>6,'channelname'=>'相册'),
        array('typeid'=>8,'channelname'=>'签证'),
        array('typeid'=>13,'channelname'=>'团购')
    );
    public function before()
    {
        parent::before();
    }
    public function action_index()
    {
        $keyword=trim($_GET['keyword']);
        $typeid=trim($_GET['typeid']);
        $keyword=empty($keyword)?trim($_POST['keyword']):$keyword;
        $typeid=empty($typeid)?trim($_POST['typeid']):$typeid;

        $pageSize=10;
        $page=$_GET['page'];
        $page=empty($page)?1:$page;
        $offset=$page*$pageSize;
        $valueArr=array();
        $w="title like :keyword";
        $valueArr[':keyword']='%'.$keyword.'%';
        if(!empty($typeid)) {
            $w.=" and typeid=:typeid";
            $valueArr[':typeid']=$typeid;
        }

        $sql="select * from sline_search where $w limit 0,$offset";
        $sqlNum="select count(*) as num from sline_search where $w";

        $query = DB::query(Database::SELECT,$sql)->parameters($valueArr);
        $totalNum=DB::query(Database::SELECT,$sqlNum)->parameters($valueArr)->execute()->get('num');

        $list=$query->execute()->as_array();
        foreach($list as $k=>$v)
        {
            $list[$k]['url']=$this->getUrl($v['tid'],$v['typeid']);
        }
        $this->assign('pageMore',$totalNum>$offset?true:false);
        $this->assign('typeid',$typeid);
        $this->assign('keyword',$keyword);
        $this->assign('nextpage',$page+1);
        $this->assign('typeArr',self::$typeArr);
        $this->assign('list',$list);
        $this->display('search/index');
    }
    public function getUrl($id,$typeid)
    {
        $cmsUrl=URL::site();
        $url='';
        switch($typeid)
        {
            case 1:
                $url=$cmsUrl.'lines/show/id/'.$id;
                break;
            case 2:
                $url=$cmsUrl.'hotels/show/id/'.$id;
                break;
            case 3:
                $url=$cmsUrl.'cars/show/id/'.$id;
                break;
            case 4:
                $url=$cmsUrl.'raider/show/id/'.$id;
                break;
            case 5:
                $url=$cmsUrl.'spot/show/id/'.$id;
                break;
            case 6:
                $url=$cmsUrl.'photo/show/id/'.$id;
                break;
            case 8:
                $url=$cmsUrl.'visa/show/id/'.$id;
                break;
            case 13:
                $url=$cmsUrl.'tuan/show/id/'.$id;
                break;

        }
        return $url;
    }


}