<style>
	.all_confs {
		width: 80%;
		margin: 0 auto;
	}
</style>

<div class='all_confs'>
	<h1>Список конференций</h1>
	<?php
		foreach( $confs as $conf ) {
			print($conf);
		}
	?>
</div>