<div class="main_photo" id="photos">
	<h2>Главная фотография</h2>
	<img alt="" src=<?="'".$main_photo."'"?>>
	<form method="POST" enctype="multipart/form-data" action="php/actions/edit_main_info/edit_main_photo.php">
		<input type="hidden" name="conf_id" value=<?="'".$conf_id."'"?>>
		<input type="file" name="photo">
		<input class="new_file_button" type="submit" value="Загрузить новое фото">
	</form>
</div>
<div class="conf_photo">
	<h2>Фото конференции</h2>
	<form method="POST" enctype="multipart/form-data" action="php/actions/edit_main_info/add_photo.php">
		<input type="hidden" name="conf_id" value=<?="'".$conf_id."'"?>>
		
		<input type="file" name="photo">
		<input class="new_file_button" type="submit" value="Загрузить фотографии">
	</form>
	<div>
		<?php
		foreach( $conf_photos as $photo ) {
			print("
			<img alt='...' src='".$photo['photo_conf']."'>
			<form method='POST' action='php/actions/edit_main_info/delete_photo.php'>
				<input type='hidden' name='photo_id' value='".$photo['ID_photo']."'>
				<input class='delete_button' type='submit' value='Удалить фото'>
			</form>
			");
			// Add div with cross to delete photo
		}
		?>
	</div>
</div>