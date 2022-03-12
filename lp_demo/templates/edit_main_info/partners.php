<div class="partners" id="partners">
	<h2>Партнёры</h2>
	<form method="POST" enctype="multipart/form-data", action="php/actions/edit_main_info/add_partner.php">
		<input type="hidden" name="conf_id" value=<?="'".$conf_id."'"?>>
		<input type="file" name="partner">
		<input class="add_button" type="submit" value="Добавить партнёра">
	</form>

	<?php
	foreach( $partners as $partner ) {
		print("
		<img alt='...' src='".$partner['logo']."'>
		<form method='POST' action='php/actions/edit_main_info/delete_partner.php'>
			<input type='hidden' name='partner_id' value='".$partner['ID_partner']."'>
			<input class='delete_button' type='submit' value='Удалить партнёра'>
		</form>
		");
	}
	?>

</div>