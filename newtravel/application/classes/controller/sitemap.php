<?php defined('SYSPATH') or die('No direct script access.');
class Controller_Sitemap extends Stourweb_Controller{

    /*
     * 智能sitemap控制器
     *
     */
    public function before()
    {
        parent::before();
        $this->assign('parentkey',$this->params['parentkey']);
        $this->assign('itemid',$this->params['itemid']);

    }
    public function action_index()
    {
        $model = new Model_SiteMap;
        $config = ORM::factory('sysconfig')->getConfig(0);

        $sitemap_info = $model->getMapInfo('Sitemap.xml',1);
        $htmlmap_info = $model->getMapInfo('Sitemap.html',2);
        $errmap_info = $model->getMapInfo('404Sitemap.txt',3);

        $isXml=file_exists(BASEPATH.'/Sitemap.xml')?1:0;
        $isHtml=file_exists(BASEPATH.'/Sitemap.html')?1:0;
        $this->assign('isxml',$isXml);
        $this->assign('ishtml',$isHtml);

        $this->assign('xmlinfo',$sitemap_info);
        $this->assign('htmlinfo',$htmlmap_info);
        $this->assign('errinfo',$errmap_info);
        $this->display('stourtravel/tools/sitemap');

    }
    /*
     * 死链地图
     * */
    public function action_errorlink()
    {
        $model = new Model_SiteMap;
        $config = ORM::factory('sysconfig')->getConfig(0);
        $errmap_info = $model->getMapInfo('404Sitemap.txt',3);
        $this->assign('errinfo',$errmap_info);
        $this->display('stourtravel/tools/errorlink');
    }

    /*
     * 生成xml地图
     * */
    public function action_ajax_xmlmap()
    {
        $model = new Model_SiteMap;
        $flag = $model->makeXmlMap();
        echo json_encode(array('status'=>$flag));

    }
    /*
     * 生成html地图
     * */
    public function action_ajax_htmlmap()
    {
        $model = new Model_SiteMap;
        $flag = $model->makeHtmlMap();
        echo json_encode(array('status'=>$flag));

    }
    /*
     * 生成死链地图
     * */
    public function action_ajax_404map()
    {
        set_time_limit(0);
        $model = new Model_SiteMap;
        $flag = $model->make404Map();
        echo json_encode(array('status'=>$flag));

    }



}