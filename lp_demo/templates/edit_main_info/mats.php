<div class="mats" id="mats_list">
	<div class="add_mat">
		<h2>Сборники материалов</h2>
		<form method="POST" enctype="multipart/form-data" action="php/actions/edit_main_info/add_mat.php">
			<input type="hidden" name="conf_id" value=<?="'".$conf_id."'"?>>

			<span class="text_ru">Описание</span>
			<input type="text" name="desc_ru">

			<span class="text_en">Description</span>
			<input type="text" name="desc_en">

			<br>

			<div class="sss">
				<div>
					<span>Обложка</span><br>
					<input type="file" name="cover">
				</div>

				<div>
					<span>Файл</span><br>
					<input type="file" name="file">
				</div>
			</div>

			<div>
				<span>Ссылка elibrary</span><br>
				<input type="text" name="elib_link">
			</div>
			<input class="add_button" type="submit" value="Добавить сборник">
		</form>
	</div>

	<div class="mid_separator"></div>
	
	<div class="mat_list">
		<h2>Список сборников материалов</h2>
		<?php
		foreach( $mats as $mat ) {
			print("
			<span class='text_ru'>Название</span><br>
			<form method='POST' action='php/actions/edit_main_info/edit_mat.php'>
				<input type='hidden' name='mat_id' value='".$mat['ID_documents']."'>

				<label><textarea name='desc_ru'>".$mat['Name_documents_ru']."</textarea></label>
				<input class=\"submit_button\" type='submit' value=''>
			</form>

			<span class='text_en'>Name</span><br>
			<form method='POST' action='php/actions/edit_main_info/edit_mat.php'>
				<input type='hidden' name='mat_id' value='".$mat['ID_documents']."'>

				<label><textarea name='desc_en'>".$mat['Name_documents_en']."</textarea></label>
				<input class=\"submit_button\" type='submit' value=''>
			</form>
			
			<div class='sss'>
				<span>Обложка</span>
				<img style='width: 200px;' alt='...' src='".$mat['cover']."'>
				<form method='POST' enctype='multipart/form-data' action='php/actions/edit_main_info/edit_mat.php'>
					<input type='hidden' name='mat_id' value='".$mat['ID_documents']."'>
					<input type='hidden' name='conf_id' value='".$conf_id."'>

					<input type='file' name='cover'>
					<input class=\"new_file_button\" type='submit' value='Загрузить новое фото'>
				</form>
			</div>

			<span>Ссылка на elibrary</span>
			<form method='POST' action='php/actions/edit_main_info/edit_mat.php'>
				<input type='hidden' name='mat_id' value='".$mat['ID_documents']."'>	

				<input type='text' name='elib_link' value='".$mat['link']."'>
				<input class='submit_button' type='submit' value=''>
			</form>

			<form method='POST' enctype='multipart/form-data' action='php/actions/edit_main_info/edit_mat.php'>
				<input type='hidden' name='mat_id' value='".$mat['ID_documents']."'>
				<input type='hidden' name='conf_id' value='".$conf_id."'>

				<input type='file' name='file'>
				<input class=\"new_file_button\" type='submit' value='Загрузить новый файл'>
			</form>

			<form method='POST' action = 'php/actions/edit_main_info/delete_mat.php'>
				<input type='hidden' name='mat_id' value='".$mat['ID_documents']."'>
				<input class='delete_button' type='submit' value='Удалить сборник'>
			</form>

			<hr>
			
			");
		}

		?>
	</div>
</div>