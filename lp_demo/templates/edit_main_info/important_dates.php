<div class="importamt_dates">
	<h2>Важные даты</h2>
	<span class="info"><img src="img/icon/warning.png"> Если дата не является промежутком, продублируйте её в обе формы</span>
	<form class="add_date" method="POST" action="php/actions/edit_main_info/add_date.php">
		<input type='hidden' name='conf_id' value=<?="'".$conf_id."'"?>>

		<span>от </span>
		<input type="date" name="begin_date">
		<span> до </span>
		<input type="date" name="end_date">

		<br>
		
		<div class="fullwblock">
			<span class="text_ru">Описание</span><br>
			<label><textarea name='text_ru'></textarea></label>
			<br>
			<span class="text_en">Description</span><br>
			<label><textarea name='text_en'></textarea></label>
		</div>
		<input class="add_button" type="submit" value="Добавить дату">
	</form>

	<div class="mid_separator"></div>

	<div class="date_list" style="max-height: 500px; overflow: hidden;">
		<?php 
			foreach ( $dates as $date ) {
				print("
				<form method=\"POST\" action='php/actions/edit_main_info/edit_date.php'>
					<h3>Дата ".$date['ID_date']."</h3>
					<span>от </span>
					<input type=\"date\" name=\"begin_date\" value='".$date['date_from']."'>
					<span> до </span>
					<input type=\"date\" name=\"end_date\" value='".$date['date_to']."'>
					<input type='hidden' name='date_id' value='".$date['ID_date']."'>
					<input class=\"submit_button\" type=\"submit\" name=\"sub_conf\" value=\"\">
				</form>

				<br>

				<form method=\"POST\" action='php/actions/edit_main_info/edit_date.php'>
					<span class=\"text_ru\">Описание</span>
					<label><textarea name=\"desc_ru\">".$date['text_ru']."</textarea></label>
					<input type='hidden' name='date_id' value='".$date['ID_date']."'>
					<input class=\"submit_button\" type=\"submit\" name=\"sub_conf\" value=\"\">
				</form>
				<form method=\"POST\" action='php/actions/edit_main_info/edit_date.php'>
					<span class=\"text_en\">Description</span>
					<label><textarea name=\"desc_en\">".$date['text_en']."</textarea></label>
					<input type='hidden' name='date_id' value='".$date['ID_date']."'>
					<input class=\"submit_button\" type=\"submit\" name=\"sub_conf\" value=\"\">
				</form>

				<form method='POST' action='php/actions/edit_main_info/delete_date.php'>
					<input type='hidden' name='date_id' value='".$date['ID_date']."'>
					<input class='delete_button' type='submit' value='Удалить дату'>
				</form>

				<div class='small_separator'></div

				");
			}
		?>
	</div>
</div>
<a id="show_all_dates" onclick="show_all_dates()" style="cursor: pointer; text-decoration: underline; color: blue;">Смотреть все даты</a>
<script>
	function show_all_dates(){
		var dl = document.getElementsByClassName("date_list")[0];
		var sad = document.getElementById("show_all_dates");
		if( dl.style.maxHeight == "100%" ) {
			dl.style.maxHeight = "500px";
			sad.innerHTML = "Смотреть все даты";
		} else {
			dl.style.maxHeight = "100%";
			sad.innerHTML = "Скрыть все даты";
		}
	}
</script>