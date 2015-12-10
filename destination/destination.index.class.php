<?php

require_once(dirname(__FILE__) . "/../include/common.inc.php");

/*

 * 获取左侧导航类

 * 

 * 此方法有一定的局限性

 *

 */

class DestinationCache

{
	
	var $Fp;



	var $configfile;



	function __construct()

	{
		$this->dsql = $GLOBALS['dsql'];

		$this->configfile = SLINEDATA . "/destination.inc.php";
	}



	private function getPid($kid)

	{

		$pid = $this->dsql->GetOne("select pid from #@__destinations where id='$kid'");

		return $pid['pid'];

	}





	public function getCacheDest()

	{

		if(file_exists(dirname(__FILE__) . "/../data/destination.inc.php"))

		{

			require_once(dirname(__FILE__) . "/../data/destination.inc.php");

			return $str;

		}

		else

		{

			$this->WriteDest();

			$str = $this->getDest();

			return $str;

		}

	}





	/*

	 * 输出左侧导航

	 * Author Snake

	 * return string

	 */

	public function getDest()

	{

		$str = '';

		$str .= $this->getSec(); //中间内容

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

			$sql = "select id,kindname from #@__destinations where pid='0' and isopen='1' order by displayorder asc";

			$top = $this->dsql->getAll($sql);

			$str = '';

			foreach($top AS $topval)

			{

				$str .= '<div class="internal">' . $topval['kindname'] . '目的地</div>';

				$msql = "select id,kindname from #@__destinations where pid='$topval[id]' and isopen='1' order by displayorder asc";

				$middle = $this->dsql->getAll($msql);

				foreach($middle AS $mval)

				{

					//if($this->checkDest($mval['id']))

					//{

						$str .= '<dl class="gdz_qz">';

						$str .= '<dt><a target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/' . $mval['id'] . '/">' . 

								$mval['kindname'] . '</a></dt>';

						$str .= '<dd>';

						$bsql = "select id,kindname from #@__destinations where pid='$mval[id]' and isopen='1' order by displayorder asc";

						$bottom = $this->dsql->getAll($bsql);

						foreach($bottom AS $bval)

						{

							//if($this->checkDest($bval['id']))

							//{

								$str .= '<a target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/' . $bval['id'] . '/"><span>' . 

								        $bval['kindname'] . '</span></a>';

							//}
							
							$str .= $this->getNextCache($bval['id']);

						}

						$str .= '</dd>';

						$str .= '</dl>';

					//}

				}

			}

		//}

		return $str;

	}
	
	
	/*

	 * 输出下级信息，实现缓存导航功能

	 * Author Snake

	 * return string-->str

	 */
	
	private function getNextCache($kid)
	{
		$sql = "select id,kindname from #@__destinations where pid='$kid' and isopen='1' order by displayorder asc";
		$res = $this->dsql->getAll($sql);

		foreach($res AS $val)

		{

			//if($this->checkDest($val['id']))

			//{

				$str .= '<a target="_blank" href="' . $GLOBALS['cfg_cmsurl'] . '/' . $val['id'] . '/"><span>' . 

						$val['kindname'] . '</span></a>';

			//}
		}
		
		return $str;
	}





	/*

	 * 输出str信息，实现缓存导航功能

	 * Author Snake

	 * return string-->str

	 */

	function WriteDest()

	{

		$this->Fp = fopen($this->configfile,'w');

		flock($this->Fp,3);

		fwrite($this->Fp,"<"."?php\r\n");

		fwrite($this->Fp,"return \$str = '");

		fwrite($this->Fp,$this->getDest());

		fwrite($this->Fp,"';\r\n");

		fwrite($this->Fp,"?".">");

		fclose($this->Fp);

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