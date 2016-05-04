

	<?php
		$query = $connection->query("SELECT *FROM questions WHERE active = 1 ORDER BY post_date DESC");

		while($row = $query->fetch_object()){
			?>
				<h1><?php echo $row->question;?></h1>
				<button onclick = "delete_question_a(<?php echo $row->id ?>)">Delete</button>
			<?php
		}
?>

