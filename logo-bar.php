<?php
$tag = new tags();
$logo = '';
if(isset($_GET['p']) && $_GET['p'] == 'projetos'):
	$tag->open('div','class="container"');
		$tag->open('a','href="index.php"');
			$logo = $tag->open('img','src="img/logoMr_projetos.png" class="help_rpg"');
		$tag->close('a');
	$tag->close('div');
elseif(isset($_GET['p']) && $_GET['p'] == 'eventos'):
	$tag->open('div','class="container"');
		$tag->open('a','href="index.php"');
			$logo = $tag->open('img','src="img/" class="help_rpg"');
		$tag->close('a');
	$tag->close('div');
elseif(isset($_GET['p']) && $_GET['p'] == 'sobre'):
	$tag->open('div','class="container"');
		$tag->open('a','href="index.php"');
			$logo = $tag->open('img','src="img/logoMr_sobre.png" class="help_rpg"');
		$tag->close('a');
	$tag->close('div');
else:
	$tag->open('div','class="container"');
		$tag->open('a','href="index.php"');
			$logo = $tag->open('img','src="img/logoMr.png" class="help_rpg"');
		$tag->close('a');
	$tag->close('div');
endif;

?>