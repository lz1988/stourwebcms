<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_SiteMap {

    private $lanmu=array(
    '1'=>'line',
    '2'=>'hotel',
    '3'=>'car',
    '4'=>'article',
    '5'=>'spot',
    '6'=>'photo',
    '7'=>'visa',
    '8'=>'tuan'

    );

    private $urlname=array(
    '1'=>'/lines/show_',
    '2'=>'/hotels/show_',
    '3'=>'/cars/show_',
    '4'=>'/raiders/show_',
    '5'=>'/spots/show_',
    '6'=>'/photo/show_',
    '7'=>'/visa/show_',
    '8'=>'/tuan/show_',

    );
    private $sonurl=array(
        '1'=>'/lines/',
        '2'=>'/hotels/',
        '3'=>'/cars/',
        '4'=>'/raiders/',
        '5'=>'/spots/',
        '6'=>'/photos/',
        '7'=>'/visa/',
        '8'=>'/tuan/'
    );
    private $filedlist=array(
        '1'=>'title',
        '2'=>'title',
        '3'=>'title',
        '4'=>'title',
        '5'=>'title',
        '6'=>'title',
        '7'=>'title',
        '8'=>'title',

    );

    /*
     * 生成xml地图
     * */
    public function makeXmlMap()
    {
        $siteInfo = $this->getWeblist();
        $content="<?xml version=\"1.0\" encoding=\"UTF-8\"?>
 <urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";

        foreach($siteInfo as $site)
        {
            $content.= $this->getMain($site);  ///获取主要节点的sitemap
            if($site['webid']==0)
            {
                $content.=$this->makeDestination();
            }

            $content.=$this->makeShow($site);

        }

        $content.="</urlset>";
        $content=str_replace('><', '>' . PHP_EOL .'<', $content);
        //文件写入操作
        if($content!="")
        {



            $siteMapFile = BASEPATH.'/Sitemap.xml';
            //文件写入
            if(Common::saveToFile($siteMapFile,$content))
            {
               $flag = 1;
            }
            else
            {
               $flag = 0;
            }
        }
        return $flag;
    }

    /*
     * 生成html地图
     *
     * */
    public function makeHtmlMap()
    {
        $siteInfo = $this->getWeblist();
        $content = "<html xmlns='http://www.w3.org/1999/xhtml'><head><meta http-equiv='Content-Type' content='text/html; charset=utf-8' /><title>网站地图</title>
			</head><body>";
        foreach($siteInfo as $site)
        {

            $content .= $this->getHtmlMain($site);
            if($site['webid']==0)
            {
                $content .= $this->makeHtmlDestination();
            }

            $content .= $this->makeShow ($site,'html');
        }


        $content .= "</body></html>";

        // 文件写入操作
        if ($content != "")
        {
            $siteMapFile = BASEPATH.'/Sitemap.html';
            //文件写入
            if(Common::saveToFile($siteMapFile,$content))
            {
                $flag = 1;
            }
            else
            {
                $flag = 0;
            }
        }
        return $flag;
    }

    /*
     * 生成死链地图
     * */
    public function make404Map()
    {

        $siteInfo = $this->getWeblist();
        $content = '';
        foreach($siteInfo as $site)
        {
            $content.=$this->make404($site);

        }

        if($content!="")
        {
            $siteMapFile = BASEPATH.'/404Sitemap.txt';
            //文件写入
            if(Common::saveToFile($siteMapFile,$content))
            {
                $flag = 1;
            }
            else
            {
                $flag = 0;
            }

        }
        return $flag;
    }

    /*
#获取主栏目页网站地图
*/
   private function getMain($site)
    {
        $weburl = $site['weburl'];
        $webid = $site['webid'];
        $mainstr = '';

        $mainstr.=$this->makeXmlFormat($weburl,1);
        for($i=1;$i<=7;$i++)
        {
            if($i<=3)
            {
                $number=0.8;
            }
            else
            {
                $number=0.9;
            }
            if($webid!=0 && $i==4)
            {
                $son = '/raider/';
            }
            else
            {
                $son = $this->sonurl[$i];
            }

            $mainstr.=$this->makeXmlFormat($weburl.$son,$number);
        }

        return $mainstr;

    }

    /*
     * xml地图格式
     * */

    private function makeXmlFormat($url,$number)
    {
        $date = date('Y-m-d');
        $str="<url><loc>".$url."</loc><lastmod>".$date."</lastmod><changefreq>daily</changefreq><priority>".$number."</priority></url>";
        return $str;
    }


    //目的地地图
    private  function makeDestination()
    {

        $date = date('Y-m-d');

        $sql = "select id,pinyin from sline_destinations where isopen=1 and pinyin!=''";

        $row = DB::query(1,$sql)->execute();


        $site = $this->getWeblist(0);
        $weburl = $site[0]['weburl'];
        $str = '';
        if($row)
        {
            foreach($row as $value)
            {
                $str.="<url><loc>".$weburl.'/'.$value['pinyin']."/</loc><lastmod>".$date."</lastmod><changefreq>daily</changefreq><priority>"."0.7"."</priority></url>";
            }
        }

        return $str;



    }

        /*
    #show页地图
    */
    private  function makeShow($site,$format='xml')
    {

        $weburl = $site['weburl'];
        $webid = $site['webid'];
        $str=$weburl;
        $show="";

        $this->urlname['1'] = $webid!=0 ? 'raider/show_' : $this->urlname['1'];
        for($i=1;$i<=8;$i++)
        {

            $string=$str.$this->urlname[$i];
            $fieldname = $this->filedlist[$i];

            $sql="select aid,{$fieldname} as title from sline_{$this->lanmu[$i]} where webid='$webid' order by aid desc";

            $arr = DB::query(1,$sql)->execute();

            foreach($arr as $row)
            {
                //Common::debug($row);
                if(!empty($row['aid']))
                {
                    $url=$string.$row['aid'].".html";
                    if($format == 'xml')
                    {
                        $show.=$this->makeXmlFormat($url,"0.5");
                    }
                    else
                    {
                        $show.=$this->makeHtmlFormat($url,$row['title']);
                    }

                }


            }

        }

        return $show;

    }


    /*--------http地图部分----------*/

    /*
    * http格式地图
    * */
    private function makeHtmlFormat($url,$name)
    {
        $str = "<a href='{$url}'>{$name}</a><br/>";
        return $str;
    }

    /*
     * 获取html主导航地图
     * */
    private function getHtmlMain($site)
    {

        $config = ORM::factory('sysconfig')->getConfig(0);
        $weburl = $site['weburl'];
        $webid = $site['webid'];
        $webname =$webid == 0 ? $config['cfg_webname'] : $site['webname'];
        $mainstr = '';
        $mainstr .= $this->makeHtmlFormat($weburl,$webname);
        for($i = 1; $i <= 8; $i ++)
        {
            if($webid!=0 && $i==4)
            {
                $son = '/raider/';
            }
            else
            {
                $son = $this->sonurl[$i];
            }
            $sql = "select shortname from sline_nav where webid='{webid}' and url='{$son}'";

            $webinfo=DB::query(1,$sql)->execute();
            if(!empty($webinfo[0]['shortname']))

                $mainstr.= $this->makeHtmlFormat($weburl ."/". $son, $webinfo[0]['shortname']);
        }

        return $mainstr;


    }

    //目的地地图
    private  function makeHtmlDestination()
    {

        $date = date('Y-m-d');

        $sql = "select id,pinyin,kindname from sline_destinations where isopen=1 and pinyin!=''";

        $row = DB::query(1,$sql)->execute();


        $site = $this->getWeblist(0);
        $weburl = $site[0]['weburl'];
        $str = '';
        if($row)
        {
            foreach($row as $value)
            {
                $url = $weburl.'/'.$value['pinyin'].'/';
                $str.=$this->makeHtmlFormat($url,$value['kindname']);
            }
        }

        return $str;



    }

    //404url
    private  function make404($site)
    {

        $weburl = $site['weburl'];
        $webid = $site['webid'];

        $str = $weburl;
        $url = '';
        for($i=1;$i<=8;$i++)
        {
            $urlname = $webid != 0 && $i==4 ? '/raider/show_' : $this->urlname[$i];


            $string=$weburl.$urlname;
            $sql="select aid from sline_{$this->lanmu[$i]} where webid='{$webid}' order by aid desc";

            $arr = DB::query(1,$sql)->execute();
            $txtcontent = array();
            foreach($arr as $row)
            {
                if(!empty($row['aid']))
                {
                    $txtcontent[]=$row['aid'];
                }
            }
            $lastaid=Common::getLastAid("sline_{$this->lanmu[$i]}",$webid);

            for($a=1;$a<=$lastaid;$a++)
            {
                if(!in_array($a,$txtcontent))
                {

                    $url.=$string.$a.".html\r\n";

                }
            }
            unset($txtcontent);
        }
        return $url;

    }

    /*
     * 获取网站列表
     * */
    private function getWeblist($webid=null)
    {
        $model = ORM::factory('weblist');
        if(!empty($webid))
        {
           $model->where('webid','=',$webid);
        }
        $arr = $model->get_all();
        return $arr;
    }


    //xml地图生成

    public function getMapInfo($file,$type=1)
    {
        $xmlpath = BASEPATH."/".$file;
        $xmlmap =file_exists($xmlpath);
        $out = array();
        if($xmlmap)
        {
            $time=date("Y-m-d H:i:s",filemtime($xmlpath));
            $fs = fopen($xmlpath,'r');
            $content = fread($fs, filesize($xmlpath));

            fclose($fs);
            if($type==1)
            {
                $locnumber=substr_count($content,"<loc>");
            }
            else if($type==2)
            {
                $locnumber=substr_count($content,"<br/>");
            }
            else if($type==3)
            {

                $locnumber=substr_count($content,"\r\n");
            }



            $out['time'] = $time;
            $out['text'] = '已经生成';
            $out['number'] = $locnumber;

        }
        else
        {
           $out['time'] = '';
           $out['text'] = '未生成';
           $out['number'] = 0;
        }

        return $out;
    }


 
}