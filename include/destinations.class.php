<?php
class destination
{
	var $Fp;
	
	var $id;
	
	var $OptionList;
	
	var $configfile;
	
	var $dir;
	
	var $_same = array();
	
	var $_next = array();
	
	var $_pre = array();
	
	function __construct($id)
    {
        $this->dsql = $GLOBALS['dsql'];
		$this->id = $id;
		$this->dir = SLINEDATA . "/dest/";
		$this->configfile = SLINEDATA . "/dest/" . $this->id . ".inc.php";
	}
	
	public function getAllKind()
	{
		$this->OptionList = '';
		$this->createdir($this->dir);
		$this->Fp = fopen($this->configfile,'w');
		flock($this->Fp,3);
		fwrite($this->Fp,"<"."?php\r\n");
		fwrite($this->Fp,"return array(\r\n");
		$this->OptionList .= "    '" . $this->id . "'=>array(\r\n";
		$this->OptionList .= "        'pre'=>" . $this->getPre($this->id);
		$this->OptionList .= "        'same'=>" . $this->getSame($this->id);
		$this->OptionList .= "        'next'=>" . $this->getNext($this->id);
		$this->OptionList .= "),\r\n";
		fwrite($this->Fp,$this->OptionList);
		fwrite($this->Fp,")\r\n");
		fwrite($this->Fp,"?".">");
		fclose($this->Fp);
	}
	
	private function getLineNum($kindid)
	{
		//$sql = "select count(id) as dd from #@__line where ishidden='0' and FIND_IN_SET($kindid,kindlist)";
		//$row = $this->dsql->GetOne($sql);
		//return $row['dd'];
		return 0;
	}
	
	private function createdir($url)
	{
		if(!is_dir($url))
		{
		   mkdir($url);
		}
	}
	
	private function getPre($id)
	{
		$sql = "select pid from #@__destinations where id='$id'";
		$res = $this->dsql->GetOne($sql);
		if($res['pid'] != 0)
		{
			$pid = $this->dsql->GetOne("select pid from #@__destinations where id='$res[pid]'");
		}
		else
		{
		  	$pid['pid'] = 0;	
		}
		
		$presql = "select id,pid,kindname,pinyin from #@__destinations where pid='$pid[pid]' and isopen='1' order by displayorder asc";
		$val = $this->dsql->getAll($presql);
		$str = '';
		$str .= "array(\r\n";
		foreach($val AS $row)
		{
			$str .= "            array('id'=>'" . $row['id'] . "','pid'=>'" . $row['pid'] . "','kindname'=>'" . $row['kindname'] . "','num'=>'','pinyin'=>'".$row['pinyin']."'),\r\n";
		}
		$str .= "),\r\n";
		return $str;
	}
	
	private function getSame($id)
	{
		$sql = "select pid from #@__destinations where id='$id'";
		$res = $this->dsql->GetOne($sql);
		$samesql = "select id,pid,kindname,pinyin from #@__destinations where pid='$res[pid]' and isopen='1' order by displayorder asc";
		$val = $this->dsql->getAll($samesql);
		$str = '';
		$str .= "array(\r\n";
		foreach($val AS $row)
		{
			$str .= "            array('id'=>'" . $row['id'] . "','pid'=>'" . $row['pid'] . "','kindname'=>'" . $row['kindname'] . "','pinyin'=>'".$row['pinyin']."','num'=>''),\r\n";
		}
		$str .= "),\r\n";
		return $str;
	}
	
	private function getNext($id)
	{
		$nextsql = "select id,pid,kindname,pinyin from #@__destinations where pid='$id' order by displayorder asc";
		$val = $this->dsql->getAll($nextsql);
		$str = '';
		$str .= "array(\r\n";
		foreach($val AS $row)
		{
			$str .= "            array('id'=>'" . $row['id'] . "','pid'=>'" . $row['pid'] . "','kindname'=>'" . $row['kindname'] . "','pinyin'=>'".$row['pinyin']."','num'=>'" . $this->getLineNum($row['id']) . "'),\r\n";
		}
		$str .= ")";
		return $str;
	}
	
	public function getDir()
	{
		$dossier = opendir ($this->dir); 
		$files = array(); 
		while ( $Fichier = readdir ( $dossier ) ) 
		{ 
			if ($Fichier != "." && $Fichier != ".." && $Fichier != "Thumbs.db") 
			{ 
				if (!is_dir ( $sitemapDir . "/" . $Fichier )) 
				{ 
					$files[] = $Fichier; 
				} 
			} 
		}
		closedir ( $dossier );
		return $files;
	}
	
	public function unlinkfile()
	{
		$arr = $this->getDir();
		foreach($arr AS $row)
		{
			@unlink($this->dir . $row);
		}
	}
	
	public function getSameList()
	{
		if(file_exists(dirname(__FILE__)."/../data/dest/" . $this->id . ".inc.php"))
		{
			$arr = $this->getFetch();
			foreach($arr AS $row)
			{
				$this->_same = $row['same'];
			}
		}
		else
		{
			$getsql="select pid,pinyin from #@__destinations where id='" . $this->id . "'";
			$row=$this->dsql->GetOne($getsql);
			$pid=$row['pid'];
			$sql="select id,kindname,pinyin from #@__destinations where pid={$pid} and isopen=1 order by displayorder asc";
			$this->_same = $this->dsql->getAll($sql);
			$this->getAllKind();
		}
		return $this->_same;
	}
	
	public function getNextList()
	{
		if(file_exists(dirname(__FILE__)."/../data/dest/" . $this->id . ".inc.php"))
		{
			$arr = $this->getFetch();
			foreach($arr AS $row)
			{
				$this->_next = $row['next'];
			}
		}
		else
		{
			$sql="select id,kindname,pinyin from #@__destinations where pid='" . $this->id . "' and isopen=1 order by displayorder asc";
			$this->_next = $this->dsql->getAll($sql);
			$this->getAllKind();
		}
		
		return $this->_next;
	}
	
	public function getPreList()
	{
		if(file_exists(dirname(__FILE__)."/../data/dest/" . $this->id . ".inc.php"))
		{
			$arr = $this->getFetch();
			foreach($arr AS $row)
			{
				$this->_pre = $row['pre'];
			}
		}
		else
		{
			$getsql = "select pid from #@__destinations where id='" . $this->id . "'";
			$row = $this->dsql->GetOne($getsql);
			$pid = $row['pid'];
			if($pid != 0)
			{
			  	$sql = "select pid from #@__destinations where id={$pid}";
			  	$row = $this->dsql->GetOne($sql);
			  	$pid = $row['pid'];
			}
			if($kindid == 0)
			{
			  	$pid = 0;	
			}
			
			$sql="select id,kindname,pinyin from #@__destinations where pid='{$pid}' and isopen=1 order by displayorder asc";
			$this->_pre = $this->dsql->getAll($sql);
			$this->getAllKind();
		}
		return $this->_pre;
	}
	
	private function getFetch()
	{
		return include(dirname(__FILE__)."/../data/dest/" . $this->id . ".inc.php");
	}
}
?>