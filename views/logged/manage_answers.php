<?php
		$query = $connection->query("SELECT *FROM answers WHERE active = 1 ORDER BY post_date DESC");

		while($row = $query->fetch_object()){
			?>
				<h1><?php echo $row->answer;?></h1>
				<button onclick = "delete_answer_a(<?php echo $row->id ?>)">Delete</button>
			<?php
		}
?>

