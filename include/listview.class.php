<?php  
  if(!defined('SLINEINC')) exit('Request Error!');
  /***** 
 * 列表视图类
 *
 * @version        $Id: view.class.php  2011年7月26日Z netman $
 * @package        Sline.Libraries
 * @copyright      Copyright (c) 2011 - 2012, Stourweb, Inc.
 * @link           http://www.stourweb.com
 ****/ 
 
require_once(SLINEINC."/sttag.class.php");
class ListView
{
    var $dsql;
    var $dtp;
	var $dtp2;
    var $TypeID;
    var $Fields;
    var $TypeLink;
    var $pvCopy;
    var $refObj;
    var $pageno;
    var $totalpage;
    var $totalresult;
    var $pagesize;
	var $sql;
	var $remoteDir;
	var $typename;//栏目名称
	var $getValues;
	var $overFlow;
    var $templetTagDir;

    /**
     *   php5构造函数
     *
     * @access    public
     * @param     int  $typeid  栏目ID
     * @param     int  $needtypelink  是否需要栏目连接
     * @return    void 
     */
    function __construct($typeid=0)
    {
        
		global $_sys_globals;
		extract($GLOBALS, EXTR_SKIP);
        $this->TypeID = $typeid;
        $this->dsql = $GLOBALS['dsql'];
        $this->dtp = new STTagParse();
        $this->dtp->SetNameSpace("sline","{","}");
        $this->dtp->SetRefObj($this);
		$this->dtp2 = new STTagParse();
        $this->dtp2->SetNameSpace("field","[","]");
        $this->remoteDir = '';
		       
        $this->Fields['typeid'] = $typeid;
        //$this->Fields['indexUrl'] = $GLOBALS['cfg_basehost'].$GLOBALS['cfg_indexurl'];
        $this->Fields['indexName'] = $GLOBALS['cfg_indexname'];
        $this->Fields['baseDir'] = $GLOBALS['cfg_basedir'];
        $this->Fields['modDir'] = $GLOBALS['cfg_templets_dir'];
		$this->overFlow=false;//是否溢出
        //$this->Fields['SplitSymbol'] = $GLOBALS['cfg_list_symbol'];
		
		
		//设置栏目
		if($typeid==1)
		{
		  $this->typename="lines";
		}
		else if($typeid==2)
		{
		  $this->typename="hotels";
		}
		else if($typeid==3)
		{
		   $this->typename="cars";
		}
		else if($typeid==4)
		{
		   $this->typename="raiders";
		}
		else if($typeid==5)
		{
		   $this->typename="spots";
		}
		else if($typeid==6)
		{
		   $this->typename="photos";
		}
		else if($typeid==13)
		{
			$this->typename="tuan";
		}
		
		
        
		//设置一些全局参数的值
        $this->Fields['phpurl'] = $cfg_phpurl;
        //$this->Fields['indexurl'] = $cfg_mainsite.$cfg_indexurl;
        $this->Fields['templeturl'] = $cfg_templeturl;
        $this->Fields['indexname'] = $cfg_indexname;
        $this->Fields['templetdef'] = $cfg_templets_dir.'/'.$cfg_df_style;

        
    }
	//设置查询的SQL语句.
	function SetSql($sql)
	{
	  $this->sql=$sql;//设置SQL
	}
	 //设置网址的Get参数键值
    function SetParameter($key,$value)
    {
        $this->getValues[$key] = $value;
    }
	//统计
	function GetCount()
	{
	    $this->totalresult = -1;
		
      
        if(isset($GLOBALS['pageno'])) $this->pageno = $GLOBALS['pageno'];
		
        else  $this->pageno = 1;
		if($this->totalresult==-1)
		{
		     $row = array();
			 $status = strpos($this->sql,'distinct') || strpos($this->sql,'Distinct');//
			 if(!$status)
			 {
			    $tsql="select count(*) as dd ".strchr($this->sql," from");
	            $tsql=str_replace(strchr($tsql,"order by"),'', $tsql);//去掉order by
				$row = $this->dsql->GetOne($tsql);
			 }
			 else
			 {
			    $tsql=str_replace(strchr($this->sql,"order by"),'', $this->sql);//去掉order by
				
				$arr = $this->dsql->getAll($tsql);
				$row['dd'] = count($arr);
				 
			 }
			 
			 
			 
			 //$tsql=str_replace(strchr($tsql,"group by"),'', $tsql);//去掉group by
			
			 
             if(is_array($row))
            {
                $this->totalresult = $row['dd'];
				if(isset($GLOBALS['totalresult']))
				{
					if($this->totalresult!=$GLOBALS['totalresult'])
					{
					  
					  $this->overFlow=true;
					 
					  
					}
				}
				if(isset($GLOBALS['pageno'],$this->pagesize))
				{
				     $totalpage = ceil($this->totalresult/$this->pagesize);
					
					 
					 if($GLOBALS['pageno']>$totalpage||$GLOBALS['pageno']==0)
					 {
					    $this->overFlow=true;
						
					 }
				}
				if($this->overFlow==true)
				{
				  header("location:{$GLOBALS['cfg_cmsurl']}/404.php");
				  exit();
				}
				
				
            }
            else
            {
                $this->totalresult = 0;
            }
		}
	}
    
    //php4构造函数
    function View($typeid=0)
    {
        $this->__construct($typeid);
    }
	
	

    /**
     *  重新指定引入的对象
     *
     * @access    private
     * @param     object  $refObj  引用对象
     * @return    void
     */
    function SetRefObj(&$refObj)
    {
        $this->dtp->SetRefObj($refObj);
        if(isset($refObj->TypeID))
        {
            $this->__construct($refObj->TypeID);
        }
    }

  

    /**
     *  设置要解析的模板
     *
     * @access    public
     * @param     string  $temp  模板
     * @param     string  $stype  设置类型
     * @return    string
     */
    function SetTemplet($temp,$stype="file")
    {
        if($stype=="string")
        {
            $this->dtp->LoadSource($temp);
        }
        else
        {
			
           if(file_exists($temp))
			{
              $this->dtp->LoadTemplet($temp);
			}
			else
			{
			  
			   
			   $temp = str_replace(SLINETEMPLATE ."/".$GLOBALS['cfg_df_style'] ."/",SLINETEMPLATE ."/smore/" ,$temp);
			   $this->dtp->LoadTemplet($temp);
			}
        }
      /*  if($this->TypeID > 0)
        {
            $this->Fields['position'] = $this->TypeLink->GetPositionLink(TRUE);
            $this->Fields['title'] = $this->TypeLink->GetPositionLink(false);
        }*/
        $this->templetTagDir = dirname($temp).'/taglib';
        $this->ParseTemplet();
    }

    /**
     *  显示内容
     *
     * @access    public
     * @return    void
     */
    function Display()
    {
        
	    $this->dtp->Display();
    }

    /**
     *  获取内容
     *
     * @access    public
     * @return    string
     */
    function GetResult()
    {
        return $this->dtp->GetResult();
    }

    /**
     *  保存结果为文件
     *
     * @access    public
     * @param     string  $filename  文件名
     * @param     string  $isremote  是否远程
     * @return    string
     */
    function SaveToHtml($filename)
    {
       
        $this->dtp->SaveTo($filename);
    }

    /**
     *  解析模板里的标签
     *
     * @access    private
     * @return    void
     */
    function ParseTemplet()
    {
        $this->GetCount();//统计数量
        $this->MakeOneTag($this->dtp,$this); //编译模板
		$this->ParseDMFields();
    }
/**
     *  解析模板，对内容里的变动进行赋值
     *
     * @access    public
     * @return    string
     */
    function ParseDMFields()
    {
		
        foreach($this->dtp->CTags as $tagid=>$ctag)
        {
            if($ctag->GetName()=="list")
            {
                $limitstart = ($this->pageno-1) * $this->pagesize;
				
                $row = $this->pagesize;
                if(trim($ctag->GetInnerText())=="")
                {
                   return'';
                }
                else
                {
                    $InnerText = trim($ctag->GetInnerText());
                }				
                $this->dtp->Assign($tagid,
                $this->GetArcList(
                $limitstart,
                $row,
                $this->typename,
                $InnerText
                )
                );
            }
            else if($ctag->GetName()=="pagelist")
            {
                $list_len = trim($ctag->GetAtt("listsize"));
				
				 $isstatic=trim($ctag->GetAtt('isstatic'));
				 
				 
				 
                $ctag->GetAtt("listitem")=="" ? $listitem="index,pre,pageno,next,end,option" : $listitem=$ctag->GetAtt("listitem");
                if($list_len=="")
                {
                    $list_len = 3;
                }
              
			  
			 
			  
			  if($isstatic)
                $this->dtp->Assign($tagid,$this->GetPageList3($list_len,$listitem));
			   else
			   {
				    $this->dtp->Assign($tagid,$this->GetPageList2($list_len,$listitem));
			   }
			
               
            }
            else if( $this->pageno!=1 && $ctag->GetName()=='field' && $ctag->GetAtt('display')!='')
            {
                $this->dtp->Assign($tagid,'');
            }
        }
    }
	

    /**
     *  获得一个单列的文档列表
     *
     * @access    public
     * @param     int  $limitstart  限制开始  
     * @param     int  $row  行数 
     * @param     string  $typname  列表类型
     * @param     string  $innertext  底层模板
     * @return    string
     */
    function GetArcList($limitstart=0,$row=10,$typename='lines',$innertext="")
    {
       
       
		
        if($row=='') $row = 10;
        if($limitstart=='') $limitstart = 0;
       
        
        $innertext = trim($innertext);
        if($innertext=='') return '';
		
		$this->sql.=" limit $limitstart,$row";
		
        $this->dsql->SetQuery($this->sql);
        $this->dsql->Execute('al');
      
        $artlist = '';
        $this->dtp2->LoadSource($innertext);
        $GLOBALS['autoindex'] = 0;
		
		
        for($i=0;$i<$row;$i++)
        {
              
                if($row = $this->dsql->GetArray("al"))
                {
					
                    $GLOBALS['autoindex']++;
                   

                    //处理一些特殊字段
					
                   /* if($row['linepic'] == '')
                    {
                        $row['linepic'] = $GLOBALS['cfg_templets_skin'].'/images/defaultpic.gif';
                    }*/
					

					$webroot=GetWebURLByWebid($row['webid']);
					if($row['webid']=='0')
						{
						  $row['url']=$webroot."/{$typename}/show_{$row['aid']}.html";
						}
						else
						{
						  if($this->TypeID==4)
						  {
							  $typename = 'raiders';
						  }
						  $row['url']=$webroot."/{$typename}/show_{$row['aid']}.html";	
						}
					   
						  $row['lit240']=getUploadFileUrl(str_replace('litimg','lit240',$row['litpic']));
			              $row['lit160']=getUploadFileUrl(str_replace('litimg','lit160',$row['litpic']));
					  
					   
						
						
                    


                  
                    if(is_array($this->dtp2->CTags))
                    {
                        foreach($this->dtp2->CTags as $k=>$ctag)
                        {
                            if($ctag->GetName()=='array')
                            {
                                //传递整个数组，在runphp模式中有特殊作用

                                $this->dtp2->Assign($k,$row);
                            }
                            else
                            {
                                if(isset($row[$ctag->GetName()]))
                                {
                                    $this->dtp2->Assign($k,$row[$ctag->GetName()]);
                                }
                                else
                                {
                                    $this->dtp2->Assign($k,'');
                                }
                            }
                        }
                    }
                    $artlist .= $this->dtp2->GetResult();
				
                }//if hasRow

           

          
        }//Loop Line

       

        //echo ($t3-$t2);
        $this->dsql->FreeResult('al');
        return $artlist;
    }

    /**
     *  获取静态的分页列表
     *
     * @access    public
     * @param     string  $list_len  列表宽度
     * @param     string  $list_len  列表样式
     * @return    string
     */
    function GetPageList($list_len,$listitem="index,end,pre,next,pageno")
    {
        $prepage = $nextpage = '';
		$geturl= $hidenform = '';
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
            //return "<li><span class=\"pageinfo\">共 <strong>0</strong>页<strong>".$this->totalresult."</strong>条记录</span></li>\r\n";
			return "<li class=\"pageinfo\">没有该分类的信息!</li>";
        }
        $purl = $this->GetCurUrl2();
        $maininfo = "<li><span class=\"jilu\">&nbsp;共&nbsp;<strong>{$totalpage}</strong>&nbsp;页<strong>&nbsp;".$this->totalresult."</strong>&nbsp;条数据&nbsp;</span></li>\r\n";
        if(count($this->getValues)>0) //设置get参数值
        {
            foreach($this->getValues as $key=>$value)
            {
                $value = urlencode($value);
                //$geturl .= "$key=$value"."&"; //动态地址 
				  $geturl.="$value"."_"; //伪静态地址
                $hidenform .= "<input type='hidden' name='$key' value='$value' />\n";
            }
        }
		// $geturl .= "totalresult=".$this->totalresult."&"; //动态地址
		 $geturl .= $this->totalresult; //伪静态地址
         $purl .= "_".$geturl;
		 
        //获得上一页和主页的链接
        if($this->pageno != 1)
        {
            
		   // $prepage.="<li><a href='".$purl."pageno=$prepagenum'>上一页</a></li>\r\n";
           // $indexpage="<li><a href='".$purl."pageno=1'>首页</a></li>\r\n";
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
            //$nextpage.="<li><a href='".$purl."pageno=$nextpagenum'>下一页</a></li>\r\n";
            //$endpage="<li><a href='".$purl."pageno=$totalpage'>末页</a></li>\r\n";
			
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
                 
				//$optionlist .= "<option value='".$purl."pageno=$mjj' selected>$mjj</option>\r\n";
				$optionlist .= "<option value='".$purl."_$mjj.html' selected>$mjj</option>\r\n";
            }
            else
            {
                //$optionlist .= "<option value='".$purl."pageno=$mjj'>$mjj</option>\r\n";
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
               // $listdd.="<li><a href='".$purl."pageno=$j'>".$j."</a></li>\r\n";
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
     *  获取动态的分页列表(悠鹿)
     *
     * @access    public
     * @param     string  $list_len  列表宽度
     * @param     string  $list_len  列表样式
     * @return    string
     */
    function GetPageList2($list_len,$listitem="index,end,pre,next,pageno")
    {


		$prepage = $nextpage = '';
		$geturl= $hidenform = '';
        $prepagenum = $this->pageno-1;
        $nextpagenum = $this->pageno+1;
        if($list_len=='' || preg_match("/[^0-9]/", $list_len))
        {
            $list_len=3;
        }
        $totalpage = ceil($this->totalresult/$this->pagesize);
		
 
        if($this->totalresult == 0)
        {
            //return "<li><span class=\"pageinfo\">共 <strong>0</strong>页<strong>".$this->totalresult."</strong>条记录</span></li>\r\n";
			  $out='<div class="nht_box" style="height:200px;width:100%; text-align:center"><img style="margin-top:40px" src="'.$GLOBALS['cfg_templets_skin'].'/images/nodata.jpg"/></div>';
			return $out;
        }
        $purl = $this->GetCurUrl();//当前地址
        
        if(count($this->getValues)>0) //设置get参数值
        {
            foreach($this->getValues as $key=>$value)
            {
                $value = urlencode($value);
                $geturl .= "$key=$value"."&"; //动态地址 
				 
                $hidenform .= "<input type='hidden' name='$key' value='$value' />\n";
            }
        }
		 $geturl .= "totalresult=".$this->totalresult; //动态地址
	      
		 $purl = $purl."?".$geturl;
		
		 $out = ' <p class="page_right"> ';
	
	//上一页
	if($this->pageno > 1)
	{
		$out.=' <a class="prev" title="上一页" href="'.$purl.'&pageno='.$prepagenum.'">上一页</a>';
	}
	
    //第一页
	if($totalpage > 1)
	{
		if($this->pageno == 1 )
		{
		   $out.='<span class="mod_pagenav_count">&nbsp;<a title="1" href="javascript:void(0);" class="current">1</a>&nbsp;';	
		}
		else
		{
		   	 $out.='<span class="mod_pagenav_count">&nbsp;<a title="1" href="'.$purl.'&pageno=1" >1</a>&nbsp;';	
		}
		
	}
	
	$out.= $totalpage >=1 ? '' : '';
	

	//是否显示省略号
    $out.= $this->pageno-2 > 2 ? '<span class="point">...</span>&nbsp;' : ''; 
	
	//中间数字部分

      
		$list_len = 2;
        $total_list = $list_len * 2 + 1;
        if($this->pageno >= $total_list)
        {
            $j = $this->pageno-$list_len;
            $total_list = $this->pageno+$list_len;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage-1;
            }
        }
        else
        {
            $j=2;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage-1;
            }
        }
        for($j;$j<=$total_list;$j++)
        {
            if($j==$this->pageno)
            {
                $out.= '<a onclick="return false;" href="javascript:void(0);" class="current">'.$this->pageno.'</a>&nbsp;';
            }
            else
            {
               $out.='<a title="'.$j.'" href="'.$purl.'&pageno='.$j.'">'.$j.'</a>&nbsp;';
            }
        }
	//结尾省略号
    if($totalpage-$currentpage > 2)
	{
	     $out.='<span class="point">...</span>&nbsp;';	
	}
	//最后一页
	if($totalpage > 1)
	{
		if($this->pageno == $totalpage)
		{
			$out.='<a title="'.$totalpage.'" href="javascript:void" class="current">'.$totalpage.'</a></span>&nbsp;';
			
		}
		else
		{
		  $out.='<a title="'.$totalpage.'" href="'.$purl.'&pageno='.$totalpage.'">'.$totalpage.'</a></span>&nbsp;';
		}
	}
	//下一页
	if($this->pageno < $totalpage)
	{
		$out.='<a class="next" title="下一页" href="'.$purl.'&pageno='.$nextpagenum.'">下一页</a>';
	}
	
      $out.='</p>';
        return $out;
    }

    /**
     *  获取动态的分页列表(静态)
     *
     * @access    public
     * @param     string  $list_len  列表宽度
     * @param     string  $list_len  列表样式
     * @return    string
     */
    function GetPageList3($list_len,$listitem="index,end,pre,next,pageno")
    {


        $prepage = $nextpage = '';
        $geturl= $hidenform = '';
        $prepagenum = $this->pageno-1;
        $nextpagenum = $this->pageno+1;
        if($list_len=='' || preg_match("/[^0-9]/", $list_len))
        {
            $list_len=3;
        }
        $totalpage = ceil($this->totalresult/$this->pagesize);


        if($this->totalresult == 0)
        {
            //return "<li><span class=\"pageinfo\">共 <strong>0</strong>页<strong>".$this->totalresult."</strong>条记录</span></li>\r\n";
            $out='<div class="nht_box" style="height:200px;width:100%; text-align:center"><img style="margin-top:40px" src="'.$GLOBALS['cfg_templets_skin'].'/images/nodata.jpg"/></div>';
            return $out;
        }
        $purl = $this->GetCurUrl2();//当前地址

        if(count($this->getValues)>0) //设置get参数值
        {
            foreach($this->getValues as $key=>$value)
            {
                $value = urlencode($value);
                $value = !empty($value) ? $value : 0 ;//为空则赋值默认值0
               //特殊判断(目的地)
                if($key == 'dest_id')
               {

                   if($value != 0)
                   {
                       $py = Helper_Archive::getDestPinyin($value);
                       $py = !empty($py) ? $py : $value;
                   }
                   else
                   {
                       $py ='all';
                   }

                   $geturl .="/".$py."-";
               }
               else
               {
                   $geturl .= "$value"."-"; //静态地址
               }



                $hidenform .= "<input type='hidden' name='$key' value='$value' />\n";
            }
            
			//if(array_key_exists('dest_id',$this->getValues))
			//{
			//	$geturl='/'.$geturl';
			//}
			

        }
       // $geturl .= "totalresult=".$this->totalresult; //动态地址
        if(strpos($geturl,'/')===false)
			 $geturl='/'.$geturl;
        $purl = $purl.$geturl;

        $out = ' <p class="page_right"> ';

        //上一页
        if($this->pageno > 1)
        {
            $out.=' <a class="prev" title="上一页" href="'.$purl.$prepagenum.'">上一页</a>';
        }

        //第一页
        if($totalpage > 1)
        {
            if($this->pageno == 1 )
            {
                $out.='<span class="mod_pagenav_count">&nbsp;<a title="1" href="javascript:void(0);" class="current">1</a>&nbsp;';
            }
            else
            {
                $out.='<span class="mod_pagenav_count">&nbsp;<a title="1" href="'.$purl.'1" >1</a>&nbsp;';
            }

        }

        $out.= $totalpage >=1 ? '' : '';


        //是否显示省略号
        $out.= $this->pageno-2 > 2 ? '<span class="point">...</span>&nbsp;' : '';

        //中间数字部分


        $list_len = 2;
        $total_list = $list_len * 2 + 1;
        if($this->pageno >= $total_list)
        {
            $j = $this->pageno-$list_len;
            $total_list = $this->pageno+$list_len;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage-1;
            }
        }
        else
        {
            $j=2;
            if($total_list>$totalpage)
            {
                $total_list=$totalpage-1;
            }
        }
        for($j;$j<=$total_list;$j++)
        {
            if($j==$this->pageno)
            {
                $out.= '<a onclick="return false;" href="javascript:void(0);" class="current">'.$this->pageno.'</a>&nbsp;';
            }
            else
            {
                $out.='<a title="'.$j.'" href="'.$purl.$j.'">'.$j.'</a>&nbsp;';
            }
        }
        //结尾省略号
        if($totalpage-$currentpage > 2)
        {
            $out.='<span class="point">...</span>&nbsp;';
        }
        //最后一页
        if($totalpage > 1)
        {
            if($this->pageno == $totalpage)
            {
                $out.='<a title="'.$totalpage.'" href="javascript:void" class="current">'.$totalpage.'</a></span>&nbsp;';

            }
            else
            {
                $out.='<a title="'.$totalpage.'" href="'.$purl.$totalpage.'">'.$totalpage.'</a></span>&nbsp;';
            }
        }
        //下一页
        if($this->pageno < $totalpage)
        {
            $out.='<a class="next" title="下一页" href="'.$purl.$nextpagenum.'">下一页</a>';
        }

        $out.='</p>';
        return $out;
    }
   
function MakeOneTag(&$dtp, &$refObj, $parfield='Y')
{
    
    $dtp->setRefObj($refObj);
    //读取自由调用tag列表
    $usertags = array(); //用户模板标签
	$templettags = array(); //当前使用模板tag
	$standardtags = array(); //标准模板tag
	$usetemppath = SLINEINC.'/taglib/'.$GLOBALS['cfg_df_style'];
    //用户模板标签
    if(is_dir($this->templetTagDir))
    {
        $utag= dir($this->templetTagDir);
        while($filename = $utag->read())
        {
            if(preg_match("/\.lib\./", $filename))
            {
                $usertags[] = str_replace('.lib.php','',$filename);
            }
        }
        $utag->Close();
    }

    if(file_exists($usetemppath))
	{
		$tetag = dir($usetemppath);
		while($filename = $tetag->read())
		{
			if(preg_match("/\.lib\./", $filename))
			{
				$templettags[] = str_replace('.lib.php','',$filename);
			}
		}
		$tetag->Close();
	}
	
    $stag = dir(SLINEINC.'/taglib/smore');
	while($filename = $stag->read())
    {
        if(preg_match("/\.lib\./", $filename))
        {
            $standardtags[] = str_replace('.lib.php','',$filename);
        }
    }
    $stag->Close();

    //遍历tag元素
    if(!is_array($dtp->CTags))
    {
        return '';
    }
    foreach($dtp->CTags as $tagid=>$ctag)
    {
        $tagname = $ctag->GetName();
        if($tagname=='field' && $parfield=='Y')
        {
            $vname = $ctag->GetAtt('name');
            if( $vname=='array' && isset($refObj->Fields) )
            {
                $dtp->Assign($tagid,$refObj->Fields);
            }
            else if(isset($refObj->Fields[$vname]))
            {
                $dtp->Assign($tagid,$refObj->Fields[$vname]);
            }
            else if($ctag->GetAtt('noteid') != '')
            {
                if( isset($refObj->Fields[$vname.'_'.$ctag->GetAtt('noteid')]) )
                {
                    $dtp->Assign($tagid, $refObj->Fields[$vname.'_'.$ctag->GetAtt('noteid')]);
                }
            }
            continue;
        }


		//先判断是否在使用模板的模板标签里面,如果存在则直接调用,如果不存在则判断是否在标准模板里,
        if(in_array($tagname,$usertags))
        {
            $filename = $this->templetTagDir.'/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
        }
        else if(in_array($tagname,$templettags))
        {
            $filename = SLINEINC.'/taglib/'.$GLOBALS['cfg_df_style'].'/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
        }
		else if(in_array($tagname,$standardtags))
		{
			$filename = SLINEINC.'/taglib/smore/'.$tagname.'.lib.php';
            include_once($filename);
            $funcname = 'lib_'.$tagname;
            $dtp->Assign($tagid,$funcname($ctag,$refObj));
			
		}
    }
  }

    //关闭所占用的资源
    function Close()
    {
    }
	
	//获取栏目title,关键词,描述.
	function GetChannelKeywords($typeid=0)
	{
	   global $dsql;
	   //如果typeid=0则读取首页默认关键词.标题
	   if($typeid==0)
	   {
	      $this->Fields['seotitle']=$GLOBALS['cfg_seotitle'];
		  $this->Fields['seokeyword']=$GLOBALS['keyword'];
		  $this->Fields['seodescription']=$GLOBALS['cfg_description'];
	   
	   }
	   else
	   {
	      $sql="select seotitle,shortname as typename ,tagword,url,keyword as seokeyword,description as seodescription,jieshao from #@__nav where typeid={$typeid}";

		  $row = $dsql->GetOne($sql);



		
		  if(is_array($row))
		  {
		     foreach($row as $k=>$v)
            {
                $this->Fields[$k] = $v;
            }
			//print_r($this->Fields);
		  }
	   
	   }
	   
	   
	
	}
 /**
     *  获得当前的页面文件的url
     *
     * @access    public
     * @return    string
     */
    function GetCurUrl()
    {

        if(!empty($_SERVER['REQUEST_URI']))
        {
            $nowurl = $_SERVER['REQUEST_URI'];
            $nowurls = explode('?', $nowurl);
            $nowurl = $nowurls[0];
        }
        else
        {
            $nowurl = $_SERVER['PHP_SELF'];
        }
        return $nowurl;
    }
 /**
     *  获得当前的页面文件的url(伪静态)
     *
     * @access    public
     * @return    string
     */
    function GetCurUrl2()
    {
        
		/* if(!empty($_SERVER['REQUEST_URI']))
        {
            $nowurl = $_SERVER['REQUEST_URI'];
           
			 $nowurl=str_replace('.html','',$nowurl);
			 $nowurl=str_replace('.php','',$nowurl);
		     $nowurls = explode('_', $nowurl);
             $nowurl = $nowurls[0];
		
        }
        else
        {
            $nowurl = $_SERVER['PHP_SELF'];
        }*/
		$nowurl=str_replace('/search.php','',$_SERVER['PHP_SELF']);
        $nowurl=str_replace('/country.php','',$nowurl);
        $nowurl=str_replace('/index.php','',$nowurl);
        return $nowurl;
    }
	
//获取栏目title,关键词,描述.
	function listGetChannelKeywords($typeid=0)
	{
	   global $dsql;
	   //如果typeid=0则读取首页默认关键词.标题
	   if($typeid==0)
	   {
	      $this->Fields['seotitle']=$GLOBALS['cfg_seotitle'];
		  $this->Fields['keywords']=$GLOBALS['cfg_keywords'];
		  $this->Fields['description']=$GLOBALS['cfg_description'];
	   
	   }
	   else
	   {
	      $sql="select seotitle,shortname as typename ,tagword,url,keyword,description,jieshao from #@__nav where typeid ={$typeid} and webid='0'";
		
		
		  $row = $dsql->GetOne($sql);
		
		  if(is_array($row))
		  {
		     foreach($row as $k=>$v)
            {
                $this->Fields[$k] = $v;
            }
			//print_r($this->Fields);
		  }
		  $this->Fields['taglook']=GetTagsLink($row['tagwords']);
	   
	   }
	   
	   
	
	}
	
	
}//End Class