<?php
/*---
  数据库备份类
  @date:2013/09/27
*/
 class Dbback
 {
	 
	public $alltables=array();
	public $sqlstr;
	public $views;
	public $tables;
	public $db;
	public $backdir;

	
	  public function __construct()
	  {
		  global $dsql;
          $this->db = $dsql;
		  $this->db->safeCheck=false;
		  $this->db->ExecuteNoneQuery("set sql_quote_show_create=0");
		  $result=$this->db->getAll("show tables");
		  $this->backdir = SLINEDATA.'/backup/';
		  
		  foreach($result as $re)
		  {
			  foreach($re as $r)
			  {
				  if(in_array($r,array('sline_admin','sline_stats','sline_stat','sline_tagword','sline_talist','sline_tmptag')))
				  continue;
				  $this->alltables[]=$r;
				  $result2=$this->db->getAll("show create table $r");
		
		      
		          foreach($result2[0] as $key=>$value)
		          {
					 if($key=='View')
				     {
					    $this->views[]=$r;
					 }
					 if($key=='Table')
					 {
						$this->tables[]=$r;
					 }
				  }
		 
			  }
		  }
		 
	  }
	
	  public function getAllTables()
	  {
		 
		  return $this->tables;
	  }
	  public function getAllViews()
	  {
		  return $this->views;
	  }
	  public function getAll()
	  {
		  return $this->alltables;
	  }
	  
	  //还原表结构
	  public function recTableStruc($table,$path)
	  {
		  global $dsql;
		  $str=file_get_contents($path);
		  if(!empty($str))
		   {
			   $str=explode(";\r\n",$str);
			  foreach($str as $st)
			     {
					 if(empty($st))
					  continue;
					 if(!$dsql->ExecuteNoneQuery($st))
					   return false;
				 }
				return true;
				 
		   }
		else 
		    return false;	
		  
	  }
	  //还原表数据
	  public function recTableData($table,$path)
	  {
		  global $dsql;
		  
		  //if(in_array($table,$this->views))
		     //return true;
		      
	    $handle = @fopen($path, "r");
			 
        while (!feof($handle)) 
	    {
          $buffer = fgets($handle, 700000);
          if(trim($buffer)=='')
		      continue;
	    	
	      if(!$dsql->ExecuteNoneQuery($buffer))
			  return false;	
        }

		 
     
		  return true;
		  
		 
	  }
	 
	 //备份表结构
	  public function backTableStruc($table,$path)
	  {
		   if(!file_exists($path))
			  mkdir($path);
		   if(!file_exists($path.'/tables'))
		        mkdir($path.'/tables');
				
		   $tablepath=$path.'/tables/';
		   $str=$this->getTableStruc($table);
		   if(file_put_contents($tablepath.$table.'.sql',$str))
		   {
			 $flag = 1;   
		   }
		   else $flag = 0 ;
		   return $flag;
		    		
	  }
	  //备份表数据
	  public function backTableData($table,$path)
	  {
		  
		 //if(in_array($table,$this->views))
		       // return;
		   if(!file_exists($path))
			  mkdir($path);
		   if(!file_exists($path.'/data'))
		        mkdir($path.'/data');
				
		   $tablepath=$path.'/data/';
		   $this->getTableData($table,$tablepath);
		   
			
		  // file_put_contents($tablepath.$table.'.sql',$str);
		  
		  
	  }
	  //写数据
	  public function writeDate($file,$data)
	  {
		    @$fp = fopen($file, 'a+');
            @flock($fp, 2);
            if(@!fwrite($fp, $data)) {
                @fclose($fp);
                $status = 0;
            } else {
				$status = 1;
                fclose($fp);
            }
			return $status;
		  
	  }
	  
	  //获取表结构(sql)
	  public function getTableStruc($tablename)
	  {
		  global $dsql;
		 
		$result=$dsql->getAll("show create table $tablename");
		
		$re=array();
		foreach($result[0] as $key=>$value)
		 {	
			$re[]=$value;   
		 }
		 
		 return "DROP TABLE IF EXISTS $tablename;\r\n".$re[1].';';
		 
		  
	  }
	  //获取表数据(sql)
	  public function getTableData($tablename,$tablepath,$filesize=2048)
	  {
		  global $dsql;
		  $result=$dsql->getAll("select * from $tablename");
		  $str='';
		  $filesize = intval($filesize * 1024 * 0.982);
		  $file = $tablepath.$tablename.'.sql';
		  foreach($result as $re)
		  {
			  if(strlen($str) <= $filesize)
			  {
				  $str.="insert into $tablename values(";
				  foreach($re as $key=>$value)
				  {
					  
						 $value=mysql_real_escape_string($value);
						  $str.="'".$value."',";
					
				  }
				  $str=substr($str,0,-1).");\r\n";
			  }
			  else
			  {
				  $flag = $this->writeDate($file,$str);
				  $str ='';
			  }
			  

			  
		  }
		  if(!empty($str))
		  {
			    $flag = $this->writeDate($file,$str);  
		  }
		  return $flag;
		  
		  
	  }
	  //备份全部数据
	  public function backupAll()
	  {
		  $tablelist = $this->getAllTables();
		  $path = $this->backdir.time();
		  //$datapath = $path.'/data/';
		  //$strucpath = $path.'/tables/';
		  foreach($tablelist as $table)
		  {
			 $flag1 = $this->backTableStruc($table,$path);
		     $flag2 = $this->backTableData($table,$path); 
		  }  
		  return true;
	  }
	   
	   
   }