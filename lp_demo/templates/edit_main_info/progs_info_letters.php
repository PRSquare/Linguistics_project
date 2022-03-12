<div class="inf_let" id="programs">
	<h2>Программки, инфармационные письма</h2>
	<form class="add_inf" enctype="multipart/form-data" method="POST" action="php/actions/edit_main_info/add_program.php">
		<input type='hidden' name='conf_id' value=<?="'".$conf_id."'"?>>

		<label><input type="file" required name="file_ru"></label>
		<span class="text_ru">Название</span>
		<input type="text" required name="name_ru">
		<br>
		<input type="file" required name="file_en">
		<span class="text_en">Name</span>
		<input type="text" required name="name_en">
		<br>
		<input class="add_button" type="submit" name="" value="Добавить программку">
	</form>

	<div class="mid_separator"></div>

	<div class="inf_list">
		<?php 
			foreach ( $programs as $prog ) {
				print("
				<h3>Программка ".$prog['ID_playbill']."</h3>
				<span class=\"text_ru\">Название</span>
				<br>
				<form method='POST' action = 'php/actions/edit_main_info/edit_program.php'>
					<input type='hidden' name='prog_id' value='".$prog['ID_playbill']."'>

					<input type=\"text\" name=\"name_ru\" value='".$prog['name_playbill_ru']."'>
					<input class=\"submit_button\" type=\"submit\" name=\"sub_conf\" value=\"\">
				</form>

				<br>

				<span class=\"text_ru\">Файл</span>

				<br>
				<form method='POST' enctype='multipart/form-data' action='php/actions/edit_main_info/edit_program.php'>
					<input type='hidden' name='prog_id' value='".$prog['ID_playbill']."'>
					<input type='hidden' name='conf_id' value='".$conf_id."'>

					<span class=\"file_name\">".$prog['name_playbill_ru']."</span>
					<input type=\"file\" name=\"file_ru\">
					<input class=\"submit_button\" type=\"submit\" name=\"sub_conf\" value=\"\">
				</form>


				<!-- Eng version -->
				
				<br>

				<span class=\"text_en\">Name</span>
				<br>  
				<form method='POST' action = 'php/actions/edit_main_info/edit_program.php'>
					<input type='hidden' name='prog_id' value='".$prog['ID_playbill']."'>

					<input type=\"text\" name=\"\" value='".$prog['name_playbill_en']."'>
					<input class=\"submit_button\" type=\"submit\" name=\"sub_conf\" value=\"\">
				</form>

				<br>

				<span class=\"text_en\">Файл</span>

				<br>
				<form method='POST' enctype='multipart/form-data' action = 'php/actions/edit_main_info/edit_program.php'>
					<input type='hidden' name='prog_id' value='".$prog['ID_playbill']."'>
					<input type='hidden' name='conf_id' value='".$conf_id."'>

					<span class=\"file_name\">".$prog['name_playbill_en']."</span>
					<input type=\"file\" name=\"file_en\">
					<input class=\"submit_button\" type=\"submit\" name=\"sub_conf\" value=\"\">
				</form>

				<form method='POST' action = 'php/actions/edit_main_info/delete_program.php'>
					<input type='hidden' name='prog_id' value='".$prog['ID_playbill']."'>
					<input class='delete_button' type='submit' value='Удалить Программку'>
				</form>
				<div class=\"small_separator\"></div>
				");
			}
		?>
	</div>
</div>