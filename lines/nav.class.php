<?php
require_once(dirname(__FILE__) . "/../include/common.inc.php");
/*
 * 获取左侧导航类
 * 
 * 此方法有一定的局限性
 *
 */
class LeftNav
{
	var $last;

	var $kid;

	var $day;

	var $priceid;

	var $attrid;

	var $Fp;

	var $configfile;

	/*function __construct($kid,$day,$priceid,$attrid)
	{
		$this->dsql = $GLOBALS['dsql'];
		$this->kid = $kid == 3681 ? 1 : $kid;
		$this->day = $day;
		$this->priceid = $priceid;
		$this->attrid = $attrid;
	}*/

	function __construct()
	{
		$this->dsql = $GLOBALS['dsql'];
		//$this->kid = 0;
		$this->day = 0;
		$this->priceid = 0;
		$this->attrid = 0;
		$this->configfile = SLINEDATA . "/nav.inc.php";
	}

	private function getPid($kid)
	{
		$pid = $this->dsql->GetOne("select pid from #@__destinations where id='$kid'");
		return $pid['pid'];
	}


	public function getStop()
	{
		if(file_exists(dirname(__FILE__) . "/../data/nav.inc.php"))
		{
			require_once(dirname(__FILE__) . "/../data/nav.inc.php");
			return $str;
		}
		else
		{
			$this->WriteNav();
			$str = $this->getNav();
			return $str;
		}
	}


	/*
	 * 输出左侧导航
	 * Author Snake
	 * return string
	 */
	public function getNav()
	{
		$str = '';
		$str .= '<div id="categorys_01" style=" position:relative; z-index:9999">' . 
			   '<div class="title_01">旅游产品分类</div>' . 
			   '<div class="mc_01" id="_JD_ALLSORT_01" load="2" style="display: block;" >' . 
			   //$this->getOne() . //中间内容
			   $this->getSec() . //中间内容
			   '<div class="item_01" style="display: block;">' . 
		       '<span><h3><a href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_3681_' . $this->day . '_' . $this->priceid . '_' . $this->attrid . '.html" target="_blank">' . 
			   '邮轮旅游</a></h3><s></s></span></div>' . 
		       '</div>' . 
			   '</div>';
		$str .= $this->script();
		return $str;
	}


	/*
	 * 获取北京的信息
	 * Author Snake
	 * return string
	 */
	public function getOne()
	{
		$str = '';
		$str .= '<div class="item_01 fore1_01" style="display: block;">';
		$str .= '<span><h3><a href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_1_' . $this->day . '_' . $this->priceid . '_' . $this->attrid . '.html" target="_blank">' . 
			    $this->getKindname($this->kid) . '旅游</a></h3><s></s></span>';
		$str .= '<div class="i-mc_01">';
		$str .= '<div class="subitem_01">';
		$str .= $this->getDay();
		$str .= $this->getAttr(); 
		$str .= '</div>';
		$str .= '</div>';
		$str .= '</div>';
		return $str;
	}


	/*
	 * 获取国内出境的信息
	 * Author Snake
	 * return string
	 */
	public function getSec()
	{
		//else
		//{
			$sql = "select id,kindname from #@__destinations where pid='0' and isopen='1'";
			$top = $this->dsql->getAll($sql);
			$str = '';
			foreach($top AS $topval)
			{
				$str .= '<div class="item_01" style="display: block;">';
				$str .= '<span><h3><a href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_' . $topval['id'] . '_' . $this->day . '_' . $this->priceid . '_' . $this->attrid . '.html" target="_blank">' . 
						$topval['kindname'] . '旅游线路</a></h3><s></s></span>';
				$str .= '<div class="i-mc_01">';
				$str .= '<div class="subitem_01">';
				$msql = "select id,kindname from #@__destinations where pid='$topval[id]' and isopen='1'";
				$middle = $this->dsql->getAll($msql);
				foreach($middle AS $mval)
				{
					if($this->checkDest($mval['id']))
					{
						$str .= '<dl>';
						$str .= '<dt><a target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_' . $mval['id'] . '_' . $this->day . '_' . $this->priceid . '_' . $this->attrid . '.html"' . $this->Bold($mval['id']) . '>' . 
								$mval['kindname'] . '</a></dt>';
						$str .= '<dd>';
						$bsql = "select id,kindname from #@__destinations where pid='$mval[id]' and isopen='1'";
						$bottom = $this->dsql->getAll($bsql);
						foreach($bottom AS $bval)
						{
							if($this->checkDest($bval['id']))
							{
								$str .= '<em><a target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_' . $bval['id'] . '_' . $this->day . '_' . $this->priceid . '_' . $this->attrid . '.html"' . $this->Bold($bval['id']) . '>' . 
								$bval['kindname'] . '</a></em>';
							}
						}
						$str .= '</dd>';
						$str .= '</dl>';
					}
				}
				$str .= '</div>';
				$str .= '</div>';
				$str .= '</div>';
			}
		//}
		return $str;
	}


	/*
	 * 输出str信息，实现缓存导航功能
	 * Author Snake
	 * return string-->str
	 */
	function WriteNav()
	{
		$this->Fp = fopen($this->configfile,'w');
		flock($this->Fp,3);
		fwrite($this->Fp,"<"."?php\r\n");
		fwrite($this->Fp,"return \$str = '");
		fwrite($this->Fp,$this->getNav());
		fwrite($this->Fp,"';\r\n");
		fwrite($this->Fp,"?".">");
		fclose($this->Fp);
	}

	
	/*
	 * 输出script信息，实现导航功能
	 * Author Snake
	 * return string-->script
	 */
	private function script()
	{
		$str = '<script>

            $("#categorys_01 div .item_01").hover(function(e){
                $(this).siblings().removeClass("hover_01").find(".i-mc_01").hide();
                $(this).addClass("hover_01");
                $(this).find(".i-mc_01").show();
            },
			function(e){
                $(this).removeClass("hover_01");
                $(this).find(".i-mc_01").hide();
            }
			);
			
			</script>';
		return $str;
	}



	/*
	 * 加粗
	 * Author Snake
	 * return string-->style
	 */
	private function Bold($kindid)
	{
		if($kindid == $this->kid)
		{
			$str = ' style="font-weight:bold;color:#f60"';
		}
		else
		{
			$str = '';
		}
		return $str;
	}


	/*
	 * 获取天数
	 * Author Snake
	 * return string
	 */
	private function getDay()
	{
		$sql="select word from #@__line_day  where webid=0 order by word asc";
		$res = $this->dsql->getAll($sql);
		$rowcount = $this->dsql->GetOne("select count(*) as dd from #@__line_day  where webid=0 order by word asc");
		$str = '';
		$str .= '<dl class="fore1">';
		$str .= '<dt><a href="javascript:;">按天数分</a></dt>';
		$str .= '<dd>';
		$idx = 0;
		foreach($res AS $row)
		{
			$idx++;
			$number=substr($row['word'],0,2);
			$arr=array("零","一","二","三","四","五","六","七","八","九");
			if(strlen($number)==1)
			{
				$result=$arr[$number];
			}
			else
			{
				if($number==10)
				{
					$result="十";
				}
				else
				{
					if($number<20)
					{
						$result="十";
					}
					else
					{
						$result=$arr[substr($number,0,1)]."十";
					}
					if(substr($number,1,1)!="0")
					{
						$result.=$arr[substr($number,1,1)]; 
					}
			   }
			}
			if($this->checkDay($row['word'])) //检测是否存在.
			{
				if($idx == $rowcount['dd'])
				{
					$str .= '<em><a rel="nofollow" target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_' . $this->kid . '_' . $row['word'] . '_' . $this->priceid . '_' . $this->attrid . '.html">' . $result."日游以上" . '</a></em>';
				}
				else
				{
					$str .= '<em><a rel="nofollow" target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_' . $this->kid . '_' . $row['word'] . '_' . $this->priceid . '_' . $this->attrid . '.html">' . $result."日游" . '</a></em>';
				}
			}
		}
		$str .= '</dd>';
		$str .= '</dl>';
		return $str;
	}

	/*
	 * 获取属性
	 * Author Snake
	 * return string
	 */
	private function getAttr()
	{
		$sql="select aid,attrname from #@__line_attr where webid=0 order by displayorder asc";
		$res = $this->dsql->getAll($sql);
		$str = '';
		$idx = 1;
		foreach($res AS $row)
		{
			$idx++;
			if($this->checkAttr($row['aid'])) //检测是否存在.
			{
				$str .= '<dl class="fore' . $idx . '">';
				$str .= '<dt><a target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_' . $this->kid . '_' . $this->day . '_' . $this->priceid . '_' . $row['aid'] . '.html">' . $row['attrname'] . '</a></dt>';
				$str .= '<dd>';
				$str .= $this->getAttrDest($row['aid']);
				$str .= '</dd>';
				$str .= '</dl>';
			}
		}
		return $str;
	}

	/*
	 * 获取属性下的目的地
	 * Author Snake
	 * return string
	 */
	private function getAttrDest($attrid)
	{
		$last = $this->getLast();
		$lastarr = explode(",",$last);
		$str = '';
		for($i=0; isset($lastarr[$i]); $i++)
		{
			$sql = "select count(*) as dd from #@__line where webid='0' and ishidden='0' and FIND_IN_SET('$lastarr[$i]',kindlist) and FIND_IN_SET('$attrid',attrid)";
			$row = $this->dsql->GetOne($sql);
			if($row['dd']>0)
			{
				$str .= '<em><a rel="nofollow" target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/lines/search_' . $lastarr[$i] . '_' . $this->day . '_' . $this->priceid . '_' . $this->attrid . '.html">' . $this->getKindname($lastarr[$i]) . '</a></em>';
			}
		}
		return $str;
	}


	/*
	 * 获取北京目的地的最后一级
	 * Author Snake
	 * return string
	 */
	private function getLast()
	{
		$sql = "select id,pid,kindname from #@__destinations where pid='" . $this->kid . "'";
		$res = $this->dsql->getAll($sql);
		$this->last = '';
		foreach($res AS $row)
		{
			//$this->getReturn($row['id']);
			if($this->checkDest($row['id']))
			{
				$this->last .= $row['id'] . ",";
			}
		}
		$this->last = substr($this->last,0,strlen($this->last)-1);
		return $this->last;
	}


	/*
	 * 循环获取(暂不适用)
	 * Author Snake
	 * return string
	 */
	private function getReturn($pid)
	{
		$sql = "select id,pid from #@__destinations where pid='$pid'";
		$row = $this->dsql->GetOne($sql);
		if(!empty($row['id']))
		{
			$this->getReturn($row['id']);
		}
		else
		{
			$this->last .= $row['id'] . ",";
		}
	}


	/*
	 * 获取kindname
	 * Author Snake
	 * return string
	 */
	private function getKindname($id)
	{
		$sql = "select kindname from #@__destinations where id='$id'";
		$row = $this->dsql->GetOne($sql);
		return $row['kindname'];
	}


	/*
	 * 验证天数里面有没有值
	 * Author Snake
	 * return @void
	 */
	private function checkDay($dayid)
	{
		$flag = 0;
		$sql = "select count(*) as num from #@__line where lineday='$dayid' and webid=0 and ishidden=0 and FIND_IN_SET('" . $this->kid . "',kindlist)";
		$row = $this->dsql->GetOne($sql);
		if($row['num']>0)
		{
			$flag = 1;
		}
		return $flag;
	}


	/*
	 * 验证属性里面有没有值
	 * Author Snake
	 * return @void
	 */
	private function checkAttr($attrid)
	{
		$flag = 0;
		$sql = "select count(*) as num from #@__line where FIND_IN_SET('" . $this->kid . "',kindlist) and FIND_IN_SET($attrid,attrid)";
		$row = $this->dsql->GetOne($sql);
		if($row['num']>0)
		$flag = 1;	
		return $flag;
	}


	/*
	 * 验证目的地里面有没有值
	 * Author Snake
	 * return @void
	 */
	private function checkDest($kindid)
	{
		$flag=0;
		$sql="select count(*) as num from #@__line where FIND_IN_SET($kindid,kindlist) and ishidden=0";
   
		$row=$this->dsql->GetOne($sql);
		if($row['num']>0)
		$flag=1;	
		return $flag;
	}
}

?>