<?php
	include 'init/db.php';
	include 'init/user.php';

	if(isset($_GET['act'])){
		if($_GET['act'] == 'load'){
			$tab = $_GET['tabNum'];
			$coeff = $_GET['coeff'];
			$id = $_GET['id'];
			$limit = $tab*$coeff;

			$query = $connection->query("SELECT *FROM answers
				WHERE active = 1 AND question_id = ".$id." LIMIT 0,".$limit);

			while ($row = $query->fetch_object()) {
				$responder_id = $row->responder_id;
			$query1 = $connection->query("SELECT *FROM users WHERE active = 1 AND id =".$responder_id." ");
				while($row1 = $query1->fetch_object()){


				?>

				<p>	<a href="?page=user_profile&id=<?php echo $row1->id;?>"><?php echo $row1->login;?></a><button class= "dbtn"onclick = "remove_answer(<?php echo $row->id;?>,<?php echo $row->question_id;?>)">X</button>
											
										<br>
										<b><?php echo $row->answer;?></b><br>
										<?php 
										$post_date = $row->post_date;
										$current_data = date('m/d/Y h:i:s a', time());
										
											?>

											<?php
										echo round(abs($post_date - $current_data) / 60). " minute ago";
										
										?>
										</p>

				<?php
			}
			}?>
				
			<?php
		}
	}

if(isset($_POST['act'])){
			if($_POST['act'] == 'list_answers'){
				$id = $_POST['id'];
				$query = $connection->query("SELECT a.answer answer, a.responder_id responder_id, u.id id, u.login login
					FROM answers a LEFT OUTER JOIN users u on a.responder_id = u.id
					 LEFT OUTER join questions q on a.question_id = q.id ");

				while($row=$query->fetch_object()){
					?>
				
					<p>
						<b><?php echo $row->login;?></b><br>
						<?php echo $row->answer;?>
					
					</p>
					<?php
				}
			}else if($_POST['act'] == 'remove_a'){


				$id = $_POST['id'];
				$query = $connection->query("UPDATE answers SET active = 0 WHERE id = ".$id." ");


			}else if($_POST['act'] == 'activate_user'){
				//echo $_POST['user_id'];
				$id = $_POST['user_id'];
				$query = $connection->query("UPDATE users SET active = 1 WHERE id = ".$id." ");
				$_SESSION['user_id'] = $id;
				unset($_SESSION['deleted_id']);
          		header("Location:?");

			}
			else if($_POST['act'] == 'delete_user'){
				$id = $_POST['user_id'];


				$query = $connection->query("UPDATE users SET active= 0 WHERE id = ".$id." ");
				unset($_SESSION['user_id']);
          		header("Location:?");


			}

				else if ($_POST['act'] == 'delete_q_admin'){
					$id = $_POST['question_id'];

					$query = $connection->query("UPDATE questions SET active = 0 WHERE id =".$id." ");



			}else if($_POST['act'] == 'delete_a_admin'){
				$id = $_POST['answer_id'];

				$query = $connection->query("UPDATE answers SET active = 0 WHERE id =".$id." ");




			}else if($_POST['act'] == 'delete_q'){

				$question_id = $_POST['question_id'];

				$query = $connection->query("UPDATE questions SET active = 0 WHERE id = ".$question_id." ");
				echo "1";
				header("Location:?");
				


			}else if($_POST['act'] == 'list_questions'){
				$query = $connection->query("SELECT *FROM questions WHERE active = 1 AND sender_id=".$_SESSION['user_id']." ORDER BY post_date DESC ");

				 while ($row = $query->fetch_object()) {
				 	?>
				 	 <h1><?php echo $row->question;?></h1>
				 	 <button class="btn"onclick="delete_question(<?php echo $row->id;?>)">Remove</button>

				 	<?php
				 	# code...
				 }



			}else if ($_POST['act'] == 'add_answer') {
				$question_id = $_POST['question_id'];
				$responder_id = $_POST['resp_id'];
				$answer = $_POST['answer'];

				echo $answer." ".$responder_id;
				$query = $connection->query("INSERT INTO answers(id,question_id,responder_id,answer,active)
									VALUES(NULL,".$question_id.",\"".$responder_id."\", \"".$answer."\",1)");
					header("Location:?");
				//echo $responder." ".$question_id." ".$answer;
			}
				
			

}
			?>

		