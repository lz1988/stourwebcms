<?php
class CommonModule
{
	
	var $db;//当前数据库对象
	var $isdebug=false;
	var $table;

	//*****构造函数*******//
	function __construct($table)
	{
		$this->db=$GLOBALS['dsql'];
		$this->table=$table;
	}
	//添加
	public function add($arr)
	{
		$sql="INSERT INTO {$this->table} (";
		$sql2="VALUES ( ";
		foreach ($arr as $key=>$value)
		{
		  $sql_key.="`".$key."`,";	
		  $sql_value.="'".$value."',";
		}
		$sql_key=substr($sql_key,0,-1).")";
		$sql_value=substr($sql_value,0,-1).")";
		$sql=$sql.$sql_key.$sql2.$sql_value.";";

		$this->db->ExecuteNoneQuery($sql);
		$id=$this->db->GetLastID();
		if($id)
		{
			return $id;
		}
		else
		{
			if($this->isdebug)
			{
			 $err=$this->db->GetError();
			 $this->db->DisplayError($err);
			}
			return false;
		}
	}
	//更新
	public function update($arr,$where)
	{
		$sql="UPDATE {$this->table} SET ";
	    foreach ($arr as $key=>$value)
		{
	      $sql_key.="`".$key."`='".$value."',";	
	    }
	    $sql_key=substr($sql_key,0,-1);
	    foreach ($where as $key=>$value)
		{
	      $sql_where.="`$key`"."='".$value."' AND";	
	    }
		$sql_where=substr($sql_where,0,-3);
		$sql=$sql.$sql_key." WHERE ".$sql_where;
		$num=$this->db->ExecuteNoneQuery2($sql);
		
		
		if($num!=-1)
		{
			return true;
		}
		else
		{
			if($this->isdebug)
			{
			 $err=$this->db->GetError();
			 $this->db->DisplayError($err);
			}
			return false;
		}
		
	}
	//删除
	public function del($id)
	{
		 $flag=1;
		 $sql="delete from {$this->table}  where id='$id'";
		 if(!$this->db->ExecuteNoneQuery($sql))
		  {
		      $gerr = $this->db->GetError();
			  $flag=$gerr;
		  }
		 return $flag; 
	}
	//获取信息
	public function getOne($where=null,$order=null,$field=null)
	{
		$f=empty($field)?'*':$field;
		$w=empty($where)?'':' where '.$where;
		$o=empty($order)?'':' order by '.$order;

		return $this->db->GetOne("select $f from {$this->table} $w $o");   
	}
	public function getAll($where=null,$order=null,$limit=null,$field=null,$leftjoin=null)
	{
		$f=empty($field)?'*':$field;
		$w=empty($where)?'':' where '.$where;
		$o=empty($order)?'':' order by '.$order;
		$l=empty($limit)?'':' limit '.$limit;
		$join = empty($leftjoin)?'':' left join '.$leftjoin;
		$sql = "select $f  from {$this->table} {$join} $w $o $l";
		
		return $this->db->getAll($sql);  
	}
	public function getField($field,$where=null)
	{
		$w=empty($where)?'':' where '.$where;
		$result=$this->db->GetOne("select $field from {$this->table} $w limit 1");
		return $result[$field];
	}
	public function getCount($where)
	{
		$sql="select count(*) as num from {$this->table} where $where";
		$result=$this->db->GetOne($sql);
		return $result['num'];
	}
}
?>