<?php

	$query = $connection->query(" SELECT * FROM users WHERE id = ".$_SESSION['user_id']);
	$query1 = $connection->query("SELECT COUNT(*) as number_of_q FROM answers WHERE responder_id = ".$_SESSION['user_id']." ");

		if($row=$query->fetch_object()){
				while($row2 = $query1->fetch_object()){
			?>
			<h1>Welcome <?php echo " ".$row->login;?>!</h1>
			<h2>
				<table>

					<tr>
						<td>
							Full Name:
						</td>
						<td>
							<?php echo $row->full_name;?>
						</td>
					</tr>	
					<tr>
						<td>
							Age:
						</td>
						<td>
							<?php echo $row->age;?>
						</td>
					</tr>

					<tr>
						<td>
							Gender:
						</td>
						<td>
							<?php echo $row->gender;?>
						</td>
					</tr>	
					<tr>
					<td>Answered questions: <?php echo $row2->number_of_q;?></td>	
					</tr>
					<tr>
						<td>	<form action="?" method="post">
                      <input type="hidden" name = "act" value = "logout">
                      <input type = "submit" value="LOGOUT" class="btn">
                    </form></td>
                    <td> <button class="btn" onclick = "deactivate_profile(<?php echo $USER_DATA->id;?>)" >Deactivate</button>
</td>
					</tr>

					<tr>
						<td>
							
						</td>
					</tr>

					<tr>
						<td>
  	<?php


	
	$query2 = $connection -> query("SELECT *FROM images where active=1 ");

	while ($row2 = $query2 ->fetch_object()) {
		$_SESSION['image_id'] = $row2->id;

		if($_SESSION['user_id']==$row2->uid){
			?>
			
			
			<img width="100" height="100" src ="<?php echo $row2->image_url;?>">
		
			<?php
}
}
?>
	
</td>
					</tr>
				</table>
			</h2>
		
		
				
			<?php

		}
	}else{
			header("Location:?");
		}
?>