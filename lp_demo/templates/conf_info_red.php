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

<div id="content">
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



	<form action="" method="post">
		<div id="test_editor">
	    	<textarea class="editor" name="editor">
	        	<p>Hello <strong>CKEditor</strong></p>
	    	</textarea>
	    </div>
	    <script>
	    	var editors_list = document.querySelectorAll('.editor');
	    	editors_list.forEach( el => ClassicEditor.create( el ) );
	    </script>    
	</form>
</div>