<?php 

// select * from mastercompany where NPWP is not null order by ftycode asc
class Mastercompany {
	protected $table = 'mastercompany';
	protected $field = '*';

	public function sql(){
		$table = $this->table;
		$field = $this->field;

		$sql = selectSql($field,$table);

		return $sql;
	}

	public function ftycode(){
		$table = $this->table;
		$field = 'Company, ftycode';
		// $where = 'NPWP is not null order by ftycode asc';
		$where = 'company_status="Y" AND ftycode NOT IN ("PBA","MAT","MAX","P15","TGR","ETR") order by Company asc';


		$sql = selectSql($field,$table,$where);

		return $sql;
	}

	public function company($ftycode){
		$table = $this->table;
		$field = 'Company, ftycode';
		// $where = 'NPWP is not null order by ftycode asc';
		$where = "ftycode='$ftycode'";
		$sql = selectSql($field,$table,$where);

		return $sql;
	}
}