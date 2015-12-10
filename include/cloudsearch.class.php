<?php
  if(!defined('SLINEINC')) exit('Request Error!');
  /***** 
 * 云搜索类
 *
 * @version        $Id: cloudsearch.class.php  2012年7月2日Z netman $
 * @package        Smore.Libraries
 * @copyright      Copyright (c) 2011 - 2012, Stourweb, Inc.
 * @link           http://www.stourweb.com
 ****/
 class CloudSearch
 {
    var $typeid;
	var $keyword;//搜索词
	var $pageno;
    var $totalresult;
    var $pagesize;
	var $database; //查询数据库
	var $table='';//查询表
	var $ws="http://search.souxw.com/service/api.asmx?WSDL";//webservice服务的地址
	//构造函数
	function __construct()
    {
        
        
    } 
	//设置参数
	function setParameter($typeid='',$keyword,$pageno,$pagesize,$database)
	{
		$this->typeid=$typeid;
		$this->keyword=urlencode($keyword);
		$this->pageno=$pageno;
		$this->pagesize=$pagesize;
		$this->database=$database;
		if($typeid=='')
		 $this->table='';
		else if($typeid==1)
		 $this->table='sline_line';
		else if($typeid==2)
		 $this->table='sline_hotel';
		else if($typeid==3)
		 $this->table='sline_car';
		else if($typeid==4)
		 $this->table='sline_article';
		else if($typeid==5)
		 $this->table='sline_spot';
		else if($typeid==6)
		 $this->table='sline_photo';
		else if($typeid=10)
		 $this->table='sline_leave';
		
	}
	//云搜索查询根据关键词获取结果
	function getSearch()
	{
		$client  = new SoapClient($this->ws); 
	    $param = array('db' => $this->database,
		               'table' => $this->table,
					   'keyword'=> $this->keyword,
					   'pageNo'=> $this->pageno,
					   'pageSize'=>$this->pagesize
					   );
					   
	   $arr = $client->__soapCall('Search',array('parameters' => $param));
	   $out=$this->handleResult($arr);
	   return $out;
	
		
	}
	
		
	
	//云搜索结果返回处理.
	
	function handleResult($arr)
	{
		$out=array();
		//print_r($arr->SearchResult);
		
		
		$this->totalresult=$arr->SearchResult->RecordCount;//总条数
		
		if($this->totalresult>0)
		{
			$result=$arr->SearchResult->Items->QueryResultItem;
			for($i=0;isset($result[$i]);$i++)
			{
				$ar=array();
				$ar['title']=$result[$i]->Title;
				$ar['aid']=$result[$i]->Aid;
				$ar['content']=$result[$i]->Content;
				$ar['tablename']=$result[$i]->Table;
				$ar['score']=$result[$i]->Score;
				$ar['webid']=$result[$i]->WebId;
				$ar['imgurl']=$result[$i]->ImgUrl;
				$ar['tag']=$result[$i]->Tag;
				array_push($out,$ar);
			}

		}
	   return $out;
	}
	
	//
	function getPageList($list_len='3',$listitem="index,end,pre,next,pageno,info")
    {
       
		$prepage = $nextpage = '';
        $prepagenum = $this->pageno-1;
        $nextpagenum = $this->pageno+1;
        if($list_len=='' || preg_match("/[^0-9]/", $list_len))
        {
            $list_len=3;
        }
        $totalpage = ceil($this->totalresult/$this->pagesize);
        if($totalpage<=1 && $this->totalresult>0)
        {

            return "<li><span class=\"jilu\">共 <strong>1</strong> 页<strong> ".$this->totalresult."</strong> 条记录</span></li>\r\n";
        }
        if($this->totalresult == 0)
        {
           
			return "<li class=\"pageinfo\">没有{$this->keyword}的相关信息!</li>";
        }
        $purl = $this->GetMyUrl();
        $maininfo = "<li><span class=\"jilu\">&nbsp;共&nbsp;<strong>{$totalpage}</strong>&nbsp;页<strong>&nbsp;".$this->totalresult."</strong>&nbsp;条数据&nbsp;</span></li>\r\n";
		
       /* if(count($this->getValues)>0) //设置get参数值
        {
            foreach($this->getValues as $key=>$value)
            {
                $value = urlencode($value);
                //$geturl .= "$key=$value"."&"; //动态地址 
				  $geturl.="$value"."_"; //伪静态地址
                $hidenform .= "<input type='hidden' name='$key' value='$value' />\n";
            }
        }*/
		// $geturl .= "totalresult=".$this->totalresult."&"; //动态地址
		 //$geturl .= $this->totalresult; //伪静态地址
        // $purl .= "_".$geturl;
		 $purl .= "_".$this->keyword."_".$this->typeid;
		 
        //获得上一页和主页的链接
        if($this->pageno != 1)
        {
		     $prepage.="<li class='up'><a href='".$purl."_$prepagenum.html'>上一页</a></li>\r\n";
             $indexpage="<li class='next'><a href='".$purl."_1.html'>首页</a></li>\r\n";
        }
        else
        {
            $indexpage="<li class='next'>首页</li>\r\n";
        }

        //下一页,未页的链接
        if($this->pageno!=$totalpage && $totalpage>1)
        {
            $nextpage.="<li class='up'><a href='".$purl."_$nextpagenum.html'>下一页</a></li>\r\n";
            $endpage="<li class='next'><a href='".$purl."_$totalpage.html'>末页</a></li>\r\n";
        }
        else
        {
            $endpage="<li class='next'>末页</li>\r\n";
        }

        //option链接
        $optionlist = '';

        $optionlen = strlen($totalpage);
        $optionlen = $optionlen*12 + 18;
        if($optionlen < 36) $optionlen = 36;
        if($optionlen > 100) $optionlen = 100;
        $optionlist = "<li class='tzy'><select name='sldd' style='width:{$optionlen}px' onchange='location.href=this.options[this.selectedIndex].value;'>\r\n";
        for($mjj=1;$mjj<=$totalpage;$mjj++)
        {
            if($mjj==$this->pageno)
            {
                 
				
				$optionlist .= "<option value='".$purl."_$mjj.html' selected>$mjj</option>\r\n";
            }
            else
            {
               
				$optionlist .= "<option value='".$purl."_$mjj.html'>$mjj</option>\r\n";
            }
        }
        $optionlist .= "</select></li>\r\n";

        //获得数字链接
        $listdd="";
        $total_list = $list_len * 2 + 1;
        if($this->pageno >= $total_list)
        {
            $j = $this->pageno-$list_len;
            $total_list = $this->pageno+$list_len;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage;
            }
        }
        else
        {
            $j=1;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage;
            }
        }
        for($j;$j<=$total_list;$j++)
        {
            if($j==$this->pageno)
            {
                $listdd.= "<li class=\"yeshu\">$j</li>\r\n";
            }
            else
            {
              
			   $listdd.="<li class='yeshu'><a href='".$purl."_$j.html'>".$j."</a></li>\r\n";
            }
        }
        $plist = '';
        if(preg_match('/index/i', $listitem)) $plist .= $indexpage;
        if(preg_match('/pre/i', $listitem)) $plist .= $prepage;
        if(preg_match('/pageno/i', $listitem)) $plist .= $listdd;
        if(preg_match('/next/i', $listitem)) $plist .= $nextpage;
        if(preg_match('/end/i', $listitem)) $plist .= $endpage;
        if(preg_match('/option/i', $listitem)) $plist .= $optionlist;
        if(preg_match('/info/i', $listitem)) $plist .= $maininfo;
        
        return $plist;
    }	
	 /**
     *  获得当前的页面文件的url(伪静态)
     *
     * @access    public
     * @return    string
     */
    function GetMyUrl()
    {

		$nowurl=str_replace('.php','',$_SERVER['PHP_SELF']);
        return $nowurl;
    }
	 
	 
 } 
  
 
 
 ?>