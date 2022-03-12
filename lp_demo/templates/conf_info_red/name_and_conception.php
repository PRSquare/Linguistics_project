<span>Название</span>
<form method="POST" action="">
	<label><textarea name='name'><?= $conf_info['Name_conf_'.$suffix] ?></textarea></label>

	<input class="submit_button" type="submit" value="">
</form>
<span>Концепция конференции</span>
<form method="POST" action="">
	<textarea class="editor" name="conception">
		<?= $conf_info['an_conception_'.$suffix] ?>
	</textarea>
	<input class="submit_button" type="submit" value="">
</form>
