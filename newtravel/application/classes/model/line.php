<?php defined('SYSPATH') or die('No direct access allowed.');

class Model_Line extends ORM {

    protected  $_table_name = 'line';
    
	public function deleteClear()
	{
		 //DB::delete('line_suit_price')->where("suitid={$this->id}")->execute();
		 $suits=ORM::factory('line_suit')->where("lineid={$this->id}")->find_all()->as_array(); 
		 foreach($suits as $suit)
		 {
			 $suit->deleteClear();
		 }
		/* Common::deleteRelativeImage($this->litpic);
		 $piclist=explode(',',$this->piclist);
		 foreach($piclist as $k=>$v)
		 {
			  $img_arr=explode('||',$v);
			  Common::deleteRelativeImage($img_arr[0]);
		 }*/
		 $this->delete();
	}

    /*
     * 提取景点
     * */
    public function autoGetSpot($content,$lineid,$day)
    {
        $sql="select a.id,a.aid,a.title,a.litpic,a.webid from #@__spot as a where a.litpic !='' or a.piclist !='' group by a.title";


        $arr = ORM::factory('spot')->where("litpic !='' or piclist !=''")->group_by('title')->get_all();

        $keysarrs = $picsarr = $idsarr = $orderarr = array();
        foreach($arr as $row)
        {

            array_push($keysarrs,$row['shortname']);
            array_push($picsarr,$row['litpic']);
            array_push($idsarr,$row['id']);
            array_push($orderarr,$row['displayorder']);

        }


        $k=0;

        $num = count($keysarrs);
        $out = array();

        for($i=0;$i < $num;$i++)
        {

            if(Common::checkStr($content,trim($keysarrs[$i])))//如果找到
            {

                $litpic=empty($picsarr[$i]) ? Common::getDefaultImage() : $picsarr[$i];
                $spotid=$idsarr[$i];
                $spotname=$keysarrs[$i];

                $autoid = $this->insertDaySpot($lineid,$spotname,$litpic,$day,$spotid);
                if($autoid)
                $out[]=array('title'=>$spotname,'spotid'=>$spotid,'autoid'=>$autoid);

            }
            $k++;
        }

        return $out;
    }
    //插入到景点库
    private function insertDaySpot($lineid,$spotname,$litpic,$day,$spotid)
    {

        $sql="select count(*) as num from sline_line_dayspot where lineid='$lineid' and spotname='$spotname' and day=$day";

        $row = $this->query($sql,1);
        $flag = 0;
        if($row[0]['num']==0)
        {
            $sql="insert into sline_line_dayspot(lineid,spotname,spotid,litpic,day) values('$lineid','$spotname','$spotid','$litpic','$day')";
            $ar = $this->query($sql,Database::INSERT);
            if($ar[0]>0)$flag = $ar[0];
        }
        return $flag;
    }

    //删除提取景点
    public function delDaySpot($autoid)
    {
        $sql = "delete from sline_line_dayspot where id= '$autoid'";
        $flag = $this->query($sql,3);
        return $flag;
    }

    //获取行程景点
    public static function getDaySpotHtml($day,$lineid)
    {
        $sql = "select * from sline_line_dayspot where lineid='$lineid' and day='$day'";
        $arr = DB::query(1,$sql)->execute();
        $out = '';
        foreach($arr as $row)
        {
            $out.='<span><s onclick="delDaySpot(this,\''.$row['id'].'\')"></s>'.$row['spotname'].'</span>';
        }
        return $out;
    }

    /*
     * 克隆线路
     * */
    public function cloneLine($id, $num)
    {

        $arr=$this->where("id=$id")->find()->as_array();
        //$earr = getLineinfoExtend($id);
        unset($arr['id']);//去除id项.
        unset($arr['starttime']);
        unset($arr['endtime']);
        unset($arr['linephone']);
        unset($arr['istejia']);
        unset($arr['ssmalprovince']);
        unset($arr['ssmalcity']);
        unset($arr['ssmalarea']);
        for($i = 1; $i <= $num; $i++)
        {
            $newaid=Common::getLastAid('sline_line',0);//新线路aid
            $arr['aid']=$newaid;

            $arr['addtime']=$arr['modtime']=time();
         //   $arr['linepic']=$this->clonePicture($arr['linepic'],$arr['webid']);
            $pics=self::clonePiclist($arr['litpic'],$arr['piclist']);

            $arr['webid'] = 0;
            $arr['litpic']=$pics['litpic'];
            $arr['piclist']=$pics['piclist'];
            $arr['lineicon'] = '0';

            $sql="INSERT INTO sline_line (";
            $sql2="VALUES ( ";
            $sql_key = '';
            $sql_value = '';
            foreach ($arr as $key=>$value)
            {
                if(!empty($value)||$key=='webid')
                {
                    $sql_key.="`".$key."`,";
                    $sql_value.="'".addslashes($value)."',";
                }
            }
            $sql_key=substr($sql_key,0,-1).")";
            $sql_value=substr($sql_value,0,-1).")";
            $sql=$sql.$sql_key.$sql2.$sql_value.";";


            $ar = $this->query($sql,2);
            $new_line_id = $ar[0];//新插入id

            $this->cloneJieShao($id,$new_line_id);
        }

        return $new_line_id;
    }
    /*
     * 克隆图片
     * */
    private function clonePicture($path,$webid)
    {

        if(empty($path))return '';

        $sourcepath=BASEPATH.$path;//原路径
        $file=explode('/',$path);
        $oldname=$file[count($file)-1];
        $te=explode('.',$oldname);

        $ext=$te[count($te)-1];

        $newname=date('Ymdhis').".".$ext;
        $newdir=date("Ymd");
        $this->cloneCreateDir(BASEPATH.'/uploads/main/litimg/'.$newdir);
        $destpath=BASEPATH.'/uploads/main/litimg/'.$newdir."/".$newname;//目标路径

        if(copy($sourcepath,$destpath)) //拷贝
        {
            return "/uploads/main/litimg/".$newdir."/".$newname;
        }
        else
        {
            return $path;
        }



    }
    //路径检查，如果不存在则创建
    private function cloneCreateDir($url)
    {

        if(!file_exists($url))
        {
            mkdir($url);
        }

    }

    /*
     * 克隆新版行程内容
     * */
    private function cloneJieShao($oldlineid,$newlineid)
    {
        $sql = "select * from sline_line_jieshao where lineid='$oldlineid'";
        $arr = $this->query($sql,1);
        $intArr = array('breakfirsthas','supperhas','lunchhas');
        foreach($arr as $row)
        {
            unset($row['id']);
            $row['lineid'] = $newlineid;
            $sql="INSERT INTO sline_line_jieshao (";
            $sql2="VALUES ( ";
            $sql_key = '';
            $sql_value = '';
            foreach ($row as $key=>$value)
            {
                if(in_array($key,$intArr))
                {
                    $value = empty($value) ? 0 : $value;
                }
                $sql_key.="`".$key."`,";
                $sql_value.="'".addslashes($value)."',";
            }
            $sql_key=substr($sql_key,0,-1).")";
            $sql_value=substr($sql_value,0,-1).")";
            $sql=$sql.$sql_key.$sql2.$sql_value.";";
            $this->query($sql,2);
        }

    }

    private function clonePiclist($litpic,$piclist)
    {
        $imgDirs=array('litimg','allimg','lit240','lit160');
        $firstPic='';
        $picArr=explode(',',$piclist);
        $newPiclist=array();
        foreach($picArr as $k=>$v)
        {
            $picInfo=explode('||',$v);
            $filename=date('YmdHis'.mt_rand(10,99));
            $suffix=substr(strrchr($picInfo[0], '.'), 1);
            $newFilename=$filename.'.'.$suffix;
            $dirName=dirname($picInfo[0]);
            $urlFile=$dirName.'/'.$newFilename;
            if($litpic==$picInfo[0])
            {
                $firstPic=$urlFile;
            }
            $picDes=empty($picInfo[1])?'':$picInfo[1];
            $newPiclist[]=$urlFile.'||'.$picDes;
            foreach($imgDirs as $dir)
            {
                $oldFile=BASEPATH.str_replace('litimg',$dir,$picInfo[0]);
                $newFile=BASEPATH.str_replace('litimg',$dir,$dirName).'/'.$newFilename;
                copy($oldFile,$newFile);
            }
        }
        return array('litpic'=>$firstPic,'piclist'=>implode(',',$newPiclist));

    }
    /*
    * 更新最低报价
    * */
    public static function updateMinPrice($lineid)
    {
	    $newtime = time();
        $sql = "SELECT MIN(adultprice) as price FROM sline_line_suit_price WHERE lineid='$lineid' and adultprice>0 and day>=$newtime";
        $ar = DB::query(1,$sql)->execute()->as_array();
        $price = $ar[0]['price'] ? $ar[0]['price'] : 0;
        $model = ORM::factory('line',$lineid);
        $model->price = $price;
        $model->update();


    }

}