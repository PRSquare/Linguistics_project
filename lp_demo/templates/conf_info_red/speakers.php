<h2 id="conf_speakers">Спикеры</h2>

<form method="POST" enctype="multipart/form-data" action="php/actions/conf_info_red/add_speaker.php">
	<span>ФИО</span>
	<label><textarea name='name'></textarea></label>
	<span>Ссылка</span>
	<label><textarea name='link'></textarea></label>
	<span>Фотография</span>
	<input type="file" name='photo'>
	<span>Информация о спикере</span>
	<label><textarea class='editor' name='info'></textarea></label>

	<input type="hidden" name="suffix" value=<?="'".$suffix."'"?>>
	<input type="hidden" name="conf_id" value=<?="'".$speakers[0]['ID_conf']."'"?>>
	<input class="add_button" type="submit" value="Добавить спикера">
</form>


<?php 
	foreach( $speakers as $speaker ) {
		print("
			<span>ФИО</span>
			<form method='POST' enctype='multipart/form-data' action='php/actions/conf_info_red/edit_speaker.php'>
				<input type='hidden' name='suffix' value='".$suffix."'>
				<input type='hidden' name='speaker_id' value='".$speaker['ID_speak']."'>
				<input type='hidden' name='conf_id' value='".$speaker['ID_conf']."'>

				<label><textarea name='name'>".$speaker[ 'name_'.$suffix ]."</textarea></label>
				<input class='submit_button' type='submit' value=''>
				
				<span>Фотография</span>
				<br>
				<img src='".$speaker['photo']."'>
				<input type='file' name='photo'>
				<input class='submit_button' type='submit' value=''>
				<br>
				<span>Информация о спикере</span>
				<label><textarea class='editor' name='info'>".$speaker[ 'info_'.$suffix ]."</textarea></label>
				<input class='submit_button' type='submit' value=''>

				<span>Ссылка на информацию о спикере</span>
				<label><textarea name='link'>".$speaker[ 'linkSP_'.$suffix ]."</textarea></label>

				<input class='submit_button' type='submit' value=''>
			</form>
			<form method='POST' action='php/actions/conf_info_red/delete_speaker.php'>
				<input type='hidden' name='speaker_id' value='".$speaker['ID_speak']."'>
				<input class='delete_button' type='submit' value='Удалить спикера'>
			</form>
			<div style='width: 100%; border-top: 3px dotted grey; margin: 20px 0;'></div>
		");		
	}
?>

