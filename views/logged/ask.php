<?php
	$query = $connection->query("SELECT * FROM users
					 WHERE id = ".$_SESSION['user_id']." AND active = 1");

	if($row = $query->fetch_object()){
				?>
			<form action="?" method="post">
				<table>
					
					<tr>
						<td>
							<h1>Your question:</h1>
						</td>
					</tr>

					<tr>
						<td>
							<textarea style="width:450px; height:100px;" name = "question"></textarea>
						</td>
					</tr>
						<tr>
						<td>
							<input type ="submit" value="ASK" class="btn">
						</td>
						<td><input type ="checkbox" name ="anonim">Anonymously</td>
					</tr>

				</table>
				
				
		
				
				
				<input type ="hidden" name="sender_id" value ="<?php echo $row->id;?>">
				<input type="hidden" value="ask_question" name="act">
				
			</form>

		<?php
	}
?>