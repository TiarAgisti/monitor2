<?php
	class Masterbuyer {
		public function sql(){
			$table = $this->table;
			$field = $this->field;

			$sql = selectSql($field,$table);

			return $sql;
		}
		
		public function listbuyer(){
			$table = 'masterbuyer';
			$field = 'BuyerCode,Buyer';
			$where = 'status="B" ORDER BY Buyer ASC';
			
			$sql = selectSql($field,$table,$where);		
			//$sql = "SELECT ".$field." FROM ".$table." WHERE ".$where;
			
			return $sql;
		}
	}
?>