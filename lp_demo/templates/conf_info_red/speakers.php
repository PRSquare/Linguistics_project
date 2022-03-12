<h2>Спикеры</h2>

<span>ФИО</span>
<form>
	<label><textarea></textarea></label>
</form>
<span>Ссылка</span>
<form>
	<label><textarea></textarea></label>
</form>
<span>Фотография</span>
<form>
	<input type="file">
</form>
<span>Информация о спикере</span>
<form>
	<label><textarea class='editor'></textarea></label>
</form>


<?php 
	foreach( $speakers as $speaker ) {
		print("
			<span>ФИО</span>
			<form>
				<label><textarea>".$speaker[ 'name_'.$suffix ]."</textarea></label>
			</form>
			<span>Фотография</span>
			<br>
			<img src='".$speaker['photo']."'>
			<br>
			<span>Информация о спикере</span>
			<form>
				<label><textarea class='editor'>".$speaker[ 'info_'.$suffix ]."</textarea></label>
			</form>
			<span>Ссылка на информацию о спикере</span>
			<form>
				<label><textarea>".$speaker[ 'linkSP_'.$suffix ]."</textarea></label>
			</form>
			<div style='width: 100%; border-top: 3px dotted grey; margin: 20px 0;'></div>
		");		
	}
?>

