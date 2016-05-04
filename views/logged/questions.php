<?php
		$query = $connection->query("SELECT *FROM questions WHERE active = 1 ORDER BY post_date DESC");


		while($row = $query->fetch_object()){

			?>
			<?php
					$user_id = $row->sender_id;



					$query2 = $connection->query("SELECT *FROM users WHERE active = 1 AND id =".$user_id." ");
					while ($row2  = $query2->fetch_object()) {
						?>

						<h1><?php echo $row->question;?> <a href="?page=user_profile&id=<?php echo $row2->id;?>"><?php echo $row2->login;?> </a></h1>
						
			
				<div id ="list_answers_<?php echo $row->id;?>">
					<?php
							$current_id = $row->id;
							$query1 = $connection ->query("SELECT *FROM answers
							 WHERE question_id =".$current_id." AND active = 1 LIMIT 0,3");

							
							while($row1 = $query1->fetch_object()){
								$responder_id = $row1->responder_id;
								$query3 = $connection->query("SELECT *FROM users WHERE active = 1 AND id = ".$responder_id." ");
								while ($row3 = $query3->fetch_object()) {
									
									?>
									<p>	<a href="?page=user_profile&id=<?php echo $row3->id;?>"><?php echo $row3->login;?></a>   <button class= "dbtn"onclick = "remove_answer(<?php echo $row1->id;?>,<?php echo $row1->question_id;?>)">X</button>

										<br>
										<b><?php echo $row1->answer;
											$rid = $_SESSION['user_id'];
											if($row1->responder_id == $rid ){
												?>
												
												<?php
											}
										?></b><br>
										<?php 
										$post_date = $row->post_date;

										$current_data = date('m/d/Y h:i:s a', time());
										

										echo round(abs($post_date - $current_data) / 60). " minute ago";
										
										?>

										

										</p>

									<?php

								}
								
							}
					?>

				</div>
				<button class="btn" onclick = "load_more(<?php echo $row->id;?>)">Load More</button>
				<input type="text" id="answer_<?php echo $row->id;?>">
				<button class = "btn" onclick="add_answer(<?php echo $row->id;?>,<?php echo "'".$USER_DATA ->id."'";?>)">ADD</button>
				

								<hr>	
			<?php

				}
		}

?>