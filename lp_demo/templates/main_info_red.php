<div class="all_blocks">
	<div class="shortcuts">
		<a class="shortcuts" href="#dates">Даты</a><br>
		<a class="shortcuts" href="#programs">Программки</a><br>
		<a class="shortcuts" href="#mats_list">Сборники материалов</a><br>
		<a class="shortcuts" href="#photos">Фотографии</a><br>
		<a class="shortcuts" href="#videos">Видео</a><br>
		<a class="shortcuts" href="#partners">Партнёры</a><br>
	</div>
	<div class="red_fields">
		<div class="data_red" name="dates">
			<form method="POST" action="php/actions/edit_main_info/edit_date.php">
				<h2>Дата конференции</h2>
				<span>от </span>
				<input type="date" name="begin_date" value=<?= "'".$begin_date."'"?>>
				<span> до </span>
				<input type="date" name="end_date" value=<?= "'".$end_date."'"?>>
				<input type="hidden" name="date_id" value=<?="'".$mdid."'"?>>
				<input class="submit_button" type="submit" name="sub_conf" value="">
			</form>
		</div>

		<?=$important_dates_template?>

		<hr>

		<?=$programs_info_letters_template?>
		

		<hr>

		<?=$mats_template?>
		
		<hr>

		<?=$photos_template?>

		<hr>

		<?=$videos_template?>

		<hr>

		<?=$partners_template?>
	</div>


	<div id="message">
		<span>Everytihg is OK!</span>
	</div>

</div>

<script>
	const anchors = document.querySelectorAll('a[href*="#"]')
	anchors.forEach((anchor) => {
	  anchor.addEventListener('click', function (e) {
	    e.preventDefault()
	    
	    const blockID = anchor.getAttribute('href').substr(1)
	    
	    document.getElementById(blockID).scrollIntoView({
	      behavior: 'smooth',
	      block: 'start'
	    })
	  })
	})
</script>