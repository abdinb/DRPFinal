<?php
	session_start();
	if($_SERVER['REQUEST_METHOD']=='POST'){
		include 'db.php';
		$file = $_FILES['avatar']['name'];
		$id = $_POST['imageID'];
		echo $id;
		$temp_file = explode(".", $file);

		$new_file = rand(1,10000).$id.".".end($temp_file);
		$image_url= "images/".$new_file;
		$id = $id +1;
		move_uploaded_file($_FILES['avatar']['tmp_name'], 'images/'.$new_file);

		$sql_query = "INSERT INTO images(id,uid,image_url,post_date,active) 
			VALUES(NULL,\"".$_SESSION['user_id']."\",\"".$image_url."\",sysdate(),1)";

			$connection->query($sql_query);
			header("Location:profile.php");
}else{
	

		//header("Location:newpost.php");	
}
?>