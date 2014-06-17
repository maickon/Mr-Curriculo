<?php
require_once 'paginas/identificacao.php';
require_once 'paginas/experiencia_academica.php';
require_once 'paginas/experiencia_programacao.php';
require_once 'paginas/experiencia_profissional.php';
require_once 'paginas/apresentacao.php';
require_once 'paginas/objetivos.php';
require_once 'paginas/interesses.php';
require_once 'paginas/idiomas.php';
$tag = new tags();
$tag->open('div','class="countainer"');
	
	foto();
	apresentacao();
	identificacao();
	experiencia_academica();
	idiomas();
	experiencia_programacao();
	experiencia_profissional();
	objetivos();
	interesses();
	
$tag->close('div');
?>