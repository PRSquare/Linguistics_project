<h2>Отзывы</h2>

<span>ФИО</span>
<form>
	<label><textarea></textarea></label>
</form>
<span>Должность</span>
<form>
	<label><textarea></textarea></label>
</form>
<span>Текст отзыва</span>
<form>
	<textarea class="editor"></textarea>
</form>

<?php 
	foreach($reviews as $review) {
		print("
			<span>ФИО</span>
			<form>
				<label><textarea>".$review['Name_feedback_'.$suffix]."</textarea></label>
			</form>
			<span>Должность</span>
			<form>
				<label><textarea>".$review['post_'.$suffix]."</textarea></label>
			</form>
			<span>Текст отзыва</span>
			<form>
				<textarea class='editor'>".$review['feedback_'.$suffix]."</textarea>
			</form>
		");
	}
?>