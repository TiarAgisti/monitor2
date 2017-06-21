<?php


function conn($query){	
//192.168.40.198
//192.168.15.203
//192.168.40.247

	$servername = '192.168.40.198';
	$username = 'webappl';
	$password = 'Master4ppL@w3b';
	$dbname = 'pancaprima';
	
	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$mysqli = mysqli_query($conn, $query);

	return $mysqli;
}

function sql($query){
	$sql['items'] = conn($query);
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

	return sql($query);	
	// return $query;
}

function insertSql($table,$res){
	foreach ($res as $key => $val) {
			$columns[] = $key;
			$values[] = $val;
		}
		
	$query = 'INSERT INTO '.$table.' ('.implode(', ', $columns).') VALUES ("'.implode('", "', $values).'")';
	// var_dump($query);
	return conn($query);
	// return $query;
}

function updateSql($table, $res, $where){
	foreach ($res as $key => $val) {
		$set[] = $key.' = "'.$val.'"';
	}
	
	$query = "UPDATE ".$table.' SET '.implode(', ', $set)." WHERE ".$where;
	return conn($query);
	// return $query;
}

function deleteSql($table, $where){
	$query = "DELETE FROM ".$table." WHERE ".$where;
	return conn($query);
	// return $query;
}