<?php  
 if(!defined('SLINEINC')) exit('Request Error!');
/**
 * 动态分页类
 * 说明:主要用于有分页效果页面使用
 * 使用方法:
 *     $dl = new DataListCP();  //初始化动态列表类
 *     $dl->pageSize = 25;      //设定每页显示记录数（默认25条）
 *     $dl->SetParameter($key,$value);  //设定get字符串的变量
 *     //这两句的顺序不能更换
 *     $dl->SetTemplate($tplfile);      //载入模板
 *     $dl->SetSource($sql);            //设定查询SQL
 *     $dl->Display();                  //显示
 *
 * @version        $Id: datalistcp.class.php 15:50 2011.05.12
 * @package        Sline.Libraries
 * @copyright      Copyright (c) 2010 - 2011, Stourweb, Inc.
 * @link           http://www.Stourweb.com
 *----*/

require_once(SLINEINC.'/sttemplate.class.php');
  $lang_pre_page = '上页';
  $lang_next_page = '下页';
  $lang_index_page = '首页';
  $lang_end_page = '末页';
  $lang_record_number = '条记录';
  $lang_page = '页';
  $lang_total = '共';
/**
 * DataListCP
 *
 * @package Stourweb.Libraries
 */
class DataListCP
{
    var $dsql;
    var $tpl;
    var $pageNO;
    var $totalPage;
    var $totalResult;
    var $pageSize;
    var $getValues;
    var $sourceSql;
    var $isQuery;
    var $queryTime;

    /**
     *  用指定的文档ID进行初始化
     *
     * @access    public
     * @param     string  $tplfile  模板文件
     * @return    string
     */
    function __construct($tplfile='')
    {
       
        $dsql = $GLOBALS['dsql'];
      
        $this->sourceSql='';
        $this->pageSize=25;
        $this->queryTime=0;
        $this->getValues=Array();
        $this->isQuery = false;
        $this->totalResult = 0;
        $this->totalPage = 0;
        $this->pageNO = 0;
        $this->dsql = $dsql;
        $this->SetVar('ParseEnv','datalist');
        $this->tpl = new STTemplate();
		$this->tpl->isCache = false;//暂时关闭缓存
      /*  if($GLOBALS['cfg_tplcache']=='N')
        {
            $this->tpl->isCache = false;
        }*/
        if($tplfile!='')
        {
            $this->tpl->LoadTemplate($tplfile);
        }
    }
    
    /**
     *  兼容PHP4版本
     *
     * @access    private
     * @param     string  $tplfile  模板文件
     * @return    void
     */
    function DataListCP($tplfile='')
    {
        $this->__construct($tplfile);
    }

    //设置SQL语句
    function SetSource($sql)
    {
        $this->sourceSql = $sql;
    }

    //设置模板
    //如果想要使用模板中指定的pagesize，必须在调用模板后才调用 SetSource($sql)
    function SetTemplate($tplfile)
    {
        $this->tpl->LoadTemplate($tplfile);
    }
    function SetTemplet($tplfile)
    {
        $this->tpl->LoadTemplate($tplfile);
    }

    /**
     *  对config参数及get参数等进行预处理
     *
     * @access    public
     * @return    void
     */
    function PreLoad()
    {
        global $totalresult,$pageno;
        if(empty($pageno) || preg_match("#[^0-9]#", $pageno))
        {
            $pageno = 1;
        }
        if(empty($totalresult) || preg_match("#[^0-9]#", $totalresult))
        {
            $totalresult = 0;
        }
        $this->pageNO = $pageno;
        $this->totalResult = $totalresult;

        if(isset($this->tpl->tpCfgs['pagesize']))
        {
            $this->pageSize = $this->tpl->tpCfgs['pagesize'];
        }
        $this->totalPage = ceil($this->totalResult / $this->pageSize);
        if($this->totalResult==0)
        {
            $countQuery = preg_replace("#SELECT[ \r\n\t](.*)[ \r\n\t]FROM#is", 'SELECT COUNT(*) AS dd FROM', $this->sourceSql);
            $countQuery = preg_replace("#ORDER[ \r\n\t]{1,}BY(.*)#is", '', $countQuery);
            $row = $this->dsql->GetOne($countQuery);
            if(!is_array($row)) $row['dd'] = 0;
            $this->totalResult = isset($row['dd'])? $row['dd'] : 0;
            $this->sourceSql .= " LIMIT 0,".$this->pageSize;
        }
        else
        {
            $this->sourceSql .= " LIMIT ".(($this->pageNO-1) * $this->pageSize).",".$this->pageSize;
        }
    }

    //设置网址的Get参数键值
    function SetParameter($key,$value)
    {
        $this->getValues[$key] = $value;
    }

    //设置/获取文档相关的各种变量
    function SetVar($k,$v)
    {
        global $_vars;
        if(!isset($_vars[$k]))
        {
            $_vars[$k] = $v;
        }
    }

    function GetVar($k)
    {
        global $_vars;
        return isset($_vars[$k]) ? $_vars[$k] : '';
    }

    //获取当前页数据列表
    function GetArcList($atts,$refObj='',$fields=array())
    {
        $rsArray = array();
        $t1 = Exectime();
        if(!$this->isQuery) $this->dsql->Execute('dlist',$this->sourceSql);
        $i = 0;
        while($arr=$this->dsql->GetArray('dlist'))
        {
            $i++;
            $rsArray[$i]  =  $arr;
            if($i >= $this->pageSize)
            {
                break;
            }
        }
        $this->dsql->FreeResult('dlist');
        $this->queryTime = (Exectime() - $t1);
		
        return $rsArray;
		
		
    }

    //获取分页导航列表
    function GetPageList($atts,$refObj='',$fields=array())
    {
        global $lang_pre_page,$lang_next_page,$lang_index_page,$lang_end_page,$lang_record_number,$lang_page,$lang_total,$pagesize;
        $prepage = $nextpage = $geturl= $hidenform = '';
        $purl = $this->GetCurUrl();
        $prepagenum = $this->pageNO-1;
        $nextpagenum = $this->pageNO+1;
        if(!isset($atts['listsize']) || preg_match("#[^0-9]#", $atts['listsize']))
        {
            $atts['listsize'] = 5;
        }
        if(!isset($atts['listitem']))
        {
            $atts['listitem'] = "info,index,end,pre,next,pageno,form";
        }
        $totalpage = ceil($this->totalResult/$this->pageSize);
        $plist = "<div class=\"pagelistbox\">\n";
		if($this->totalResult!=0)
			{
				$this->getValues['totalresult'] = $this->totalResult;
			}
			if(count($this->getValues)>0)
			{
				foreach($this->getValues as $key=>$value)
				{
					$value = urlencode($value);
					$geturl .= "$key=$value"."&";
					$hidenform .= "<input type='hidden' name='$key' value='$value' />\n";
				}
			}
			$purl .= "?".$geturl;
        //echo " {$totalpage}=={$this->totalResult}=={$this->pageSize}";
        //无结果或只有一页的情况
		if($this->totalResult == 0)
			{
				
				return "<span>{$lang_total}</span> <span><span class='displaynum'>0</span> {$lang_page} <span class='displaynum'>".$this->totalResult."</span>".$lang_record_number."</span>";
			}
		
            if($totalpage<=1 && $this->totalResult > 0)
            {
			  $plist.= "<span>{$lang_total} <span class='displaynum'>1</span> {$lang_page} <span class='displaynum'>".$this->totalResult."</span>  ".$lang_record_number."</span>";
					
			 if(preg_match("#form#i", $atts['listitem']))
             {
                $plist.="<span>每页显示</span>";
				$plist.="<select  onChange='javascript:location.href=this.options[this.selectedIndex].value'>";
				$plist.= "<option value='".$purl."pagesize=30'".$this->GetPageSizeSlelect($pagesize,30).">30条</option>";
				if($this->totalResult>30)
				{
				  $plist.="<option value='".$purl."pagesize=60'".$this->GetPageSizeSlelect($pagesize,60).">60条</option>";
				}
				if($this->totalResult>60)
				{
				  $plist.="<option value='".$purl."pagesize=100'".$this->GetPageSizeSlelect($pagesize,100).">100条</option>";
				}
			    $plist.="</select>";
			
              }
		   	   $plist .= "</div>\n";
			   return $plist;
            }
	
			
			$infos = "<span>{$lang_total}<span class='displaynum'>{$totalpage}</span> {$lang_page}<span class='displaynum'>{$this->totalResult}</span> {$lang_record_number} </span> ";
			
		
			//获得上一页和下一页的链接
			if($this->pageNO != 1)
			{
				$prepage .= "<a class='prePage' href='".$purl."pageno=$prepagenum'>$lang_pre_page</a> \n";
				$indexpage = "<a class='indexPage' href='".$purl."pageno=1'>$lang_index_page</a> \n";
			}
			else
			{
				$indexpage = "<span class='indexPage'>"."$lang_index_page\n"."</span> ";
			}
			if($this->pageNO != $totalpage && $totalpage > 1)
			{
				$nextpage.="<a class='nextPage' href='".$purl."pageno=$nextpagenum'>$lang_next_page</a> \n";
				$endpage="<a class='endPage' href='".$purl."pageno=$totalpage'>$lang_end_page </a> \n";
			}
			else
			{
				$endpage=" <span><strong>$lang_end_page</strong></span> \n";
			}
		
			//获得数字链接
			$listdd = "    ";
			$total_list = $atts['listsize'] * 2 + 1;
			if($this->pageNO >= $total_list)
			{
				$j = $this->pageNO - $atts['listsize'];
				$total_list=$this->pageNO + $atts['listsize'];
				if($total_list > $totalpage)
				{
					$total_list = $totalpage;
				}
			}
			else
			{
				$j=1;
				if($total_list > $totalpage)
				{
					$total_list = $totalpage;
				}
			}
			for($j; $j<=$total_list; $j++)
			{
				$listdd .= $j==$this->pageNO ? "<strong>$j</strong>\n" : "<a class='pageno' href='".$purl."pageno=$j'>".$j."</a>\n";
			}
		  
			
		
			//info,index,end,pre,next,pageno,form
			if(preg_match("#info#i",$atts['listitem']))
			{
				$plist .= $infos;
			}
			if(preg_match("#index#i", $atts['listitem']))
			{
				$plist .= $indexpage;
			}
			if(preg_match("#pre#i", $atts['listitem']))
			{
				$plist .= $prepage;
			}
			if(preg_match("#pageno#i", $atts['listitem']))
			{
				$plist .= $listdd;
			}
			if(preg_match("#next#i", $atts['listitem']))
			{
				$plist .= $nextpage;
			}
			if(preg_match("#end#i", $atts['listitem']))
			{
				$plist .= $endpage;
			}
	
        if(preg_match("#form#i", $atts['listitem']))
        {
                $plist.="<span>每页显示</span>";
				$plist.="<select  onChange='javascript:location.href=this.options[this.selectedIndex].value'>";
				$plist.= "<option value='".$purl."pagesize=30'".$this->GetPageSizeSlelect($pagesize,30).">30条</option>";
				if($this->totalResult>30)
				{
				  $plist.="<option value='".$purl."pagesize=60'".$this->GetPageSizeSlelect($pagesize,60).">60条</option>";
				}
				if($this->totalResult>60)
				{
				  $plist.="<option value='".$purl."pagesize=100'".$this->GetPageSizeSlelect($pagesize,100).">100条</option>";
				}
			$plist.="</select>";
		
					
			 
			

			
        }
        $plist .= "</div>\n";
        return $plist;
    }

    //获得当前网址
    function GetCurUrl()
    {
        if(!empty($_SERVER["REQUEST_URI"]))
        {
            $nowurl = $_SERVER["REQUEST_URI"];
            $nowurls = explode("?",$nowurl);
			
            $nowurl = $nowurls[0];
        }
        else
        {
            $nowurl = $_SERVER["PHP_SELF"];
        }
        return $nowurl;
    }
	//当前pagesize是否选中
	function GetPageSizeSlelect($pagesize,$value)
	{
	    $str="";
		if($pagesize==$value)
		{
		  $str="selected";
		}
		return $str;
	}

    //关闭
    function Close()
    {

    }

    //显示数据
    function Display()
    {
        $this->PreLoad();

        //在PHP4中，对象引用必须放在display之前，放在其它位置中无效
        $this->tpl->SetObject($this);
        $this->tpl->Display();
    }

    //保存为HTML
    function SaveTo($filename)
    {
        $this->tpl->SaveTo($filename);
    }
	
	//获取栏目title,关键词,描述.
	function GetChannelKeywords($typeid=0)
	{
	   global $dsql,$_vars;
	   //如果typeid=0则读取首页默认关键词.标题
	   if($typeid==0)
	   {
	      $_vars['seotitle']=$GLOBALS['cfg_seotitle'];
		  $_vars['keywords']=$GLOBALS['cfg_keywords'];
		  $_vars['description']=$GLOBALS['cfg_description'];
	   
	   }
	   else
	   {
	      $sql="select seotitle,keywords,description from #@__nav where id={$typeid}";
		  
		 
		
		  $row = $dsql->GetOne($sql);
		  
		  
		
		  if(is_array($row))
		  {
		     foreach($row as $k=>$v)
            {
                $_vars[$k] = $v;
            }
			
		  }
	   
	   }
	   
	   
	
	}
}