<?php
	
	if(isset($_GET['id'])){
		 $id = $_GET['id'];
       	
		$query = $connection->query("INSERT INTO answers_like (uid,aid)
											SELECT {$_SESSION['user_id']}, {$id}
											FROM answers
											WHERE EXISTS(
												SELECT id
												FROM answers
												WHERE id = {$id}) 
											AND NOT EXISTS(
													SELECT id
													FROM answers_like
													WHERE uid = {$_SESSION['user_id']}
													AND aid = {id})
													LIMIT 1
					");
		//header("Location:?");
	}
?>

