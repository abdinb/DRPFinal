<?php
	//include 'init/db.php';

	$query = $connection->query("SELECT *FROM users WHERE id = ".$_SESSION['user_id']);

	if($row = $query->fetch_object()){
		?>
			<form action="?" method="post">
				<table>
				<tr>
				<td>Full Name:</td>
				<td><input name="full_name" value="<?php echo $row->full_name;?>"
       onfocus="(this.value == '<?php echo $row->full_name;?>') && (this.value = '')"
       onblur="(this.value == '') && (this.value = '<?php echo $row->full_name;?>')" /></td>
			</tr>
			<tr>
				<td>Login:</td>
				<td><input name="login" value="<?php echo $row->login;?>"
       onfocus="(this.value == '<?php echo $row->full_name;?>') && (this.value = '')"
       onblur="(this.value == '') && (this.value = '<?php echo $row->full_name;?>')" /></td>

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
						<td>
							<input type="hidden" name="act" value="edit_profile">
							<input type="submit" value="Change" class="btn">
						</td>
				</tr>

			</table>

			</form>

	<?php
			$query1 = $connection->query("SELECT *FROM images WHERE uid = ".$_SESSION['user_id']." ");
			if($row=$query1->fetch_object()){

				?>
				<?php
	$i = 0;
	$i=$i + 1;

	?>
				To Change avatar: 
				<form action="?" method="post" enctype="multipart/form-data">
	<input type="file" name="avatar">
	<input type="hidden" name="imageID" value ="<?php echo $i;?>">
	<input type="hidden" name = "act" value = "change_photo">
	<input type="submit" value="Upload">


</form>

		<?php
	}else{
		?>
		<?php
	$i = 0;
	$i=$i + 1;

	?>
		Upload avatar:
		<form action="?" method="post" enctype="multipart/form-data">
	<input type="file" name="avatar">
	<input type="hidden" name="imageID" value ="<?php echo $i;?>">
	<input type="hidden" name = "act" value = "upload_photo">
	<input type="submit" value="Upload">

</form>
		<?php
	}
}
		?>
