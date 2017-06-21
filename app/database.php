<?php
	$server = array();

	$server= ['host'=>'192.168.15.203',
				'username'=>'root',
				'password'=>'mastersandi',
				'database'=>'pancaprima'];

	

	function conn($server){

			$servername = $server['host'];
			$username = $server['username'];
			$password = $server['password'];
			$dbname = $server['database'];
			
			$conn = mysqli_connect($servername, $username, $password, $dbname);

			if (!$conn) {
			    die("Connection failed: " . mysqli_connect_error());
			} else {
				$mysqli = mysqli_query($conn, $query);
				return $mysqli;
			}

	}

	function sql($query,$server){
		// $sql['items'] = conn($query,$server);
		// $sql['count'] = $sql['items']->num_rows;
		// $sql['exist'] = ($sql['count'] > 0)? true : false;

		// return $sql;
		// var_dump(conn($query,$server));
		var_dump($query);
		var_dump($server);
	}

	$query = "select UserName, Password from userpassword where UserName = '011500035'";
	$result = $sql($query,$server);

	conn($server)
