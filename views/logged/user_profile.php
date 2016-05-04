<?php

	$id = $_GET['id'];

	$query = $connection->query(" SELECT * FROM users WHERE active = 1 AND id = ".$id);
	$query1 = $connection->query("SELECT COUNT(*) as number_of_q FROM answers WHERE active = 1 AND responder_id = ".$id." ");

		if($row=$query->fetch_object()){
				while($row2 = $query1->fetch_object()){
			?>
			<h1><?php echo " ".$row->login;?></h1>
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

				</table>
			</h2>
		
			
			<?php

		}
	}else{
			header("Location:?");
		}
?>