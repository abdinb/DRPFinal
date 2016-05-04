<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
		include 'db.php';

		$login = $_POST['login'];
		$password = $_POST['password'];
		$full_name = $_POST['full_name'];
		
		$query = $connection->query("INSERT INTO users(id,login,full_name) VALUES (NULL,\"".$login."\",\"".$password."\",\"".$full_name."\",1)
									");

		if($row = $query->fetch_object()){
			
			session_start();
			$_SESSION['user_id'] = $row->id;
			header("Location:?");
		}
	}


?>