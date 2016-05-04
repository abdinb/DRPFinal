
            <h1>Statistics</h1>
   
            <?php
              $query = $connection->query("SELECT COUNT(id) AS qnum FROM questions where active = 1");
              
              while($row = $query->fetch_object()){
                ?>
             <b><i>Questions:</i><?php echo $row->qnum;?></b><br>

            <?php
          }
            $query1 = $connection->query("SELECT COUNT(id) AS anum FROM answers");
            while($row1 = $query1->fetch_object()){
            ?>
            <b><i>Answers:</i><?php echo $row1->anum;?>
                <?php

              }
            ?>
            
						  
<?php

		$query3 = $connection->query("SELECT COUNT(id) as unum FROM users");

		while($row3 = $query3->fetch_object()){
			?>
			<br>
			<b><i>Users:</i><?php echo $row3->unum;?>
		
			<?php
		}

?>


<br>
<br>

	<form action="?" method="post">
                      <input type="hidden" name = "act" value = "logout">
                      <input type = "submit" value="LOGOUT" class="btn">
                    </form>