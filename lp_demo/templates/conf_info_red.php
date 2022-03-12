<style type="text/css">
	#test_editor {
		width: 80%;
	}
	.ck-editor__editable_inline {
		min-height: 400px;
	}
	#content {
		width: 60%;
		margin: 0 auto;
	}
</style>

<?= $nav_template?>

<div id="content">
	<h1>Конференция <?=$conf_date?></h1>
	<?= $name_and_conception_template ?>
	<hr>
	<?= $announcement_template ?>
	<hr>
	<?= $about_conf_template ?>
	<hr>
	<?= $speakers_template ?>
	<hr>
	<?= $reviews_template ?>
	<hr>



    <script>
    	var editors_list = document.querySelectorAll('.editor');
    	editors_list.forEach( el => ClassicEditor.create( el ) );
    </script>
</div>

<script>
	enableSmoothScroll();
</script>