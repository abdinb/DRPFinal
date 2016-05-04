<?php
		$connection = new mysqli("localhost","root","","lq.kz");

		if(!$connection->connect_error){

				define("CONNECTED",true);

				}else{

					define("CONNECTED",false);

	}


?>
