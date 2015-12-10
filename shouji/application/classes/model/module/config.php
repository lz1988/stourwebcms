<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Module_Config extends ORM {


    /*
     * 获取配置页面列表
     * @param string webid
     * @param string typeid
     * */

    public function getPageList($webid,$typeid)
    {
        $arr = $this->select(array('pagename','aid'))->where('webid','=',$webid)->and_where('typeid','=',$typeid)->get_all();
        //$arr = DB::query(1,"select pagename,aid from sline_module_config where webid='$webid' and typeid='$typeid'")->execute();
        //print_r($arr);
      /*
        foreach( $arr as $row )
        {
            $str.="<li onclick='GetSelectItem({$row['aid']})' id='nav_{$row['aid']}'>{$row['pagename']}</li>";
        }*/
        return $arr;
    }

   /*
    * 根据pageid获取配置了的模块
    * */
    public function getSelectItem($pageid,$webid)
    {

        $out = array();
        $row = $this->select(array('moduleids'))->where('aid','=',$pageid)->and_where('webid','=',$webid)->find()->as_array();

        $mids=$row['moduleids'];
        $midarr = Common::removeEmpty(explode(',',$mids));
        foreach($midarr as $aid)
        {
            $sql = "select modulename,aid from sline_module_list where aid ='$aid' and webid=$webid";
            $row = DB::query(Database::SELECT,$sql)->execute()->as_array();
            $out[]=$row[0];
        }


        return $out;

       /* if(isset($mids))
        {
            $mids=explode(',',$row['moduleids']);//拆分
            for($i=0;isset($mids[$i]);$i++)
            {
                $sql="select modulename,aid from #@__module_list where aid='{$mids[$i]}' and webid=$webid";
                $dsql->SetQuery($sql);
                $dsql->Execute();
                while($arr=$dsql->GetArray())
                {
                    $str.="<div id='{$arr['aid']}' class='sitem'>";
                    $str.="<div class='title'>{$arr['modulename']}</div>";
                    $str.="<div class='del' onclick='del({$arr['aid']})' value='{$arr['aid']}'><img src='images/close.jpg'></div></div>";
                    $itemids.="{$arr['aid']},";

                }
            }
            $itemids=substr($itemids,0,strlen($itemids)-1);
            $str.="<input type='hidden' id='pageid' value='{$pageid}' /> ";
            $str.="<input type='hidden' id='itemsarr' value='{$itemids}'/>";
            echo $str;

        }
        else
        {
            echo "没有找到相应模块";
        }*/
        return $out;
    }
	 
}