<h2>Анонс</h2>

<span>Вступление</span>
<form method="POST" action="">
	<label><textarea name='introduction'><?= $conf_info['anons_name_'.$suffix] ?></textarea></label>
</form>

<span>Информация об анонсе</span>
<form method="POST" action="">
	<textarea class='editor' name='announcment_info'><?= $conf_info['info_anons_'.$suffix] ?></textarea>
</form>
