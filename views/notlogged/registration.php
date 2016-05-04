<form action="?" method="post">

		<table>
			<tr>
				<td>Full Name:</td>
				<td><input type="text" name="full_name"></td>
			</tr>
			<tr>
				<td>Login:</td>
				<td><input type ="text" name ="login"></td>
			</tr>

			<tr>
				<td>Password:</td>
				<td><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>
					<select name="age">
			<?php
				for($i=1;$i<=90;$i++){
			?>

				<option value="<?php echo $i;?>"><?php echo $i;?></option>				

			<?php
				}
			?>
			
		</select>
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="genderU" value="male">Male<br>
				</td>
			</tr>
			<tr>
				<td>
					<input type="radio" name="genderU" value="female">Female
				</td>
			</tr>
			<tr>
				
				<td><input type = "hidden" name = "act" value = "to_register"></td>
			</tr>
			<tr>
				<td><input type="submit" class="btn" value ="Register me"></td>
			</tr>

		</table>
	
		
		
</form>