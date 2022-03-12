<h2 id="conf_feedback">Отзывы</h2>

<span>ФИО</span>
<form method="POST" action="php/actions/conf_info_red/add_review.php">
	<input type="hidden" name="conf_id" value=<?="'".$reviews[0]['ID_conf']."'"?>>
	<input type='hidden' name='suffix' value=<?="'".$suffix."'"?>>
	<label><textarea name='name'></textarea></label>
	<span>Должность</span>
	<label><textarea name='position'></textarea></label>
	<span>Текст отзыва</span>
	<textarea class="editor" name='text'></textarea>
	<input class="add_button" type="submit" value="Добавить отзыв" >
</form>

<?php 
	foreach($reviews as $review) {
		print("
			<form method='POST' action='php/actions/conf_info_red/edit_review.php'>
				<input type='hidden' name='id_feedback' value='".$review['ID_feedback']."'>
				<input type='hidden' name='suffix' value='".$suffix."'>
				
				<span>ФИО</span>
				<label><textarea name='name'>".$review['Name_feedback_'.$suffix]."</textarea></label>
				<input class='submit_button' type='submit' value=''>
				
				<span>Должность</span>
				<label><textarea name='position'>".$review['post_'.$suffix]."</textarea></label>
				<input class='submit_button' type='submit' value=''>
				
				<span>Текст отзыва</span>
				<textarea class='editor' name='text'>".$review['feedback_'.$suffix]."</textarea>
				<input class='submit_button' type='submit' value=''>
			</form>
			<form method='POST' action='php/actions/conf_info_red/delete_review.php'>
				<input type='hidden' name='id_feedback' value='".$review['ID_feedback']."'>
				<input class='delete_button' type='submit' value='Удалить отзыв'>
			</form>
		");
	}
?>