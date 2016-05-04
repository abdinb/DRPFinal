<form action="?" method="post" enctype="multipart/form-data">
	<input type="file" name="avatar">
	<input type="hidden" name="imageID" value ="<?php echo $i;?>">
	<input type="hidden" name = "act" value = "upload_photo">
	<input type="submit" value="Upload">

	<?php echo $i;?>
</form>
