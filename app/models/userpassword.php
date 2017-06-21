<?php

class Userpassword {
	protected $table = 'userpassword';
	protected $field = '*';

	public function sql(){
		$table = $this->table;
		$field = $this->field;

		$sql = selectSql($field,$table);

		return $sql;
	}

	public function update($data,$cond){
		$table = $this->table;
		$where = 'UserName = "'.$cond[0].'"';
		$sql = updateSql($table,$data,$where);

		return $sql;
	}

	public function login_($user,$pass){
		$table = 'userpassword a, mastercompany b, masterdepartment c';
		$field = 'a.UserName, a.level_id, a.permission, a.sbu, b.ftycode, c.deptcode, a.DeptName';
		$where = 'a.company = b.Company AND a.DeptName = c.DeptName AND UserName = "'.$user.'" AND Password = "'.$pass.'"';

		//$sql = selectSql($field,$table,$where);
		
		$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

		return $sql;
	}

	public function login($nik,$pass){
		$table = 'userpassword a, mastercompany b, masterdepartment c';
		$field = 'a.nik, a.UserName,a.FullName, a.level_id, a.permission, a.sbu, b.ftycode, c.deptcode,a.Groupp';
		$where = 'a.company = b.Company AND a.DeptName = c.DeptName AND nik = "'.$nik.'" AND Password = "'.$pass.'"';
		
		//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

		$sql = selectSql($field,$table,$where);

		return $sql;
	}

	public function details($nik){
		$table = 'userpassword a, mastercompany b, masterdepartment c, user_level d';
		$field = 'a.UserName, a.FullName, a.level_id, a.permission, a.sbu, a.company, a.DeptName, a.nik, a.email, b.ftycode, c.deptcode, d.level_name';
		$where = 'a.company = b.Company AND a.DeptName = c.DeptName AND a.level_id = d.level_id AND nik = "'.$nik.'"';

		$sql = selectSql($field,$table,$where);

		return $sql;
	}

	public function checkuser($data){
		$table = 'userpassword a, mastercompany b, masterdepartment c, user_level d';
		$field = 'a.UserName, a.FullName, a.level_id, a.permission, a.sbu, a.company, a.DeptName, a.nik, a.email, b.ftycode, c.deptcode, d.level_name';
		$where = 'a.company = b.Company AND a.DeptName = c.DeptName AND a.level_id = d.level_id AND UserName = "'.$data.'"';

		$sql = selectSql($field,$table,$where);

		return $sql;
	}

	public function username($data){
		$table = 'userpassword a, mastercompany b';
		$field = 'a.UserName';
		$where = 'a.company = b.Company AND nik = "'.$data[0].'" AND b.ftycode ="'.$data[1].'"';

		$sql = selectSql($field,$table,$where);

		return $sql;
	}

	public function username2($data){
		$table = 'userpassword a, mastercompany b';
		$field = 'a.UserName';
		$where = 'a.company = b.Company AND nik = "'.$data[0].'" AND app_by="1"';

		$sql = selectSql($field,$table,$where);

		return $sql;
	}
	
	public function fullname($data){
		$table = 'userpassword';
		$field = 'FullName,email';
		$where = 'UserName ="'.$data.'"';

		$sql = selectSql($field,$table,$where);

		return $sql;
	}

	public function multi($a,$nik){
		$table = 'userpassword a, mastercompany b';
		$field = 'a.sbu, b.ftycode';		

		$group = '';

		if ($a == 'sbu') {
			$group = ' GROUP BY sbu';
		}

		$where = 'a.company = b.Company AND nik ="'.$nik.'"'.$group;

		$sql = selectSql($field,$table,$where);

		return $sql;
	}


	/*===================================================================================================================
	====================================================   A R I E F   ==================================================
	=====================================================================================================================*/	
	public function app_by($tapp){
		$table = 'userpassword a, mastercompany b, user_level c';
		$field = 'a.Fullname AS Fullname,a.username AS username, c.level_name as Deptname';

		$where = 'a.company = b.Company AND a.level_id=c.level_id AND app_by="1" ORDER BY a.level_id DESC';
		
		$sql = selectSql($field,$table,$where);
		
		//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

		return $sql;
	}
	
	public function app_by2($lvl1,$Dpt1,$lvl2,$Dpt2){
		//var_dump();
		if($Dpt1<>"")
		{
			$tambah1 = " AND DeptName='".$Dpt1."'";
		}
		else
		{
			$tambah1 = "";
		}
		
		if($Dpt2<>"")
		{
			$tambah2 = " AND DeptName='".$Dpt2."'";
		}
		else
		{
			$tambah2 = "";
		}
		
		$table = 'userpassword a, mastercompany b, user_level c';
		$field = 'a.Fullname AS Fullname,a.username AS username, a.DeptName as Deptname,a.level_id AS level_id  FROM userpassword a, mastercompany b 
				  WHERE a.company = b.Company AND app_by="1" AND a.level_id ="'.$lvl1.'"'.$tambah1.'
				  UNION ALL
				  SELECT a.Fullname AS Fullname,a.username AS username, c.level_name as Deptname,a.level_id AS level_id';

		$where = 'a.company = b.Company AND a.level_id=c.level_id AND app_by="1" AND a.level_id ="'.$lvl2.'"'.$tambah2.' ORDER BY a.level_id DESC, Fullname ASC';
		
		
		$sql = selectSql($field,$table,$where);
		
		//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;

		return $sql;
	}
	/*=====================================   END ARIEF ===================================================*/
	
	//=============================================Gilang==================================================
	public function fullnamenik($data){
		$table = 'userpassword';
		$field = 'FullName';
		$where = 'nik ="'.$data.'" order by FullName asc';

		$sql = selectSql($field,$table,$where);

		return $sql;
	}

}