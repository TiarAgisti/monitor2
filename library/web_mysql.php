<?php

/**
* class for connection database web panbrotherstbk
*/
class conn_mysql_web
{

	private function conn($query){

		$servername = '192.168.0.247';
		$username = 'arief';
		$password = 'mastersandi';
		$dbname = 'psikotes';
		
		// Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		// Check connection
		if (!$conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}

		$mysqli = mysqli_query($conn, $query);

		return $mysqli;
	}

	private function sql($query){
		$sql['items'] = self::conn($query);
		$sql['count'] = $sql['items']->num_rows;
		$sql['exist'] = ($sql['count'] > 0)? true : false;

		return $sql;
	}

	function selectSql($field,$table,$where){
		if ($where != null) {
			$query = "SELECT ".$field." FROM ".$table." WHERE ".$where;
		} else {
			$query = "SELECT ".$field." FROM ".$table;
		}

		return self::sql($query);	
	}

	function insertSql($table,$res){
		foreach ($res as $key => $val) {
				$columns[] = $key;
				$values[] = $val;
			}
			
		$query = 'INSERT INTO '.$table.' ('.implode(', ', $columns).') VALUES ("'.implode('", "', $values).'")';
		return self::conn($query);
		// return $query;
	}

	function updateSql($table, $res, $where){
		foreach ($res as $key => $val) {
			$set[] = $key.' = "'.$val.'"';
		}
		
		$query = "UPDATE ".$table.' SET '.implode(', ', $set)." WHERE ".$where;
		return self::conn($query);
		// return $query;
	}
	
	function updateSql2($table, $res){
		foreach ($res as $key => $val) {
			$set[] = $key.' = "'.$val.'"';
		}
		
		$query = "UPDATE ".$table.' SET '.implode(', ', $set);
		return self::conn($query);
		// return $query;
	}

	function deleteSql($table, $where){
		$query = "DELETE FROM ".$table." WHERE ".$where;
		return self::conn($query);
		// return $query;
	}


}