<?php

$tag = new tags();
$sobre = new sobre();
$sobre->seleciona_tudo($sobre);
$tag->open('div','class="span10 offset1"');
	$tag->open('h3','class="panel titulo"');
		$tag->inprime('Sobre o site MR-Currículo');	
	$tag->close('h3');
$tag->close('div');
while($sobre_resp = $sobre->retorna_dados()):	
	$tag->open('div','class="span10 offset1"');
		apresentar_item_curriculo('', $sobre_resp->texto);
	$tag->close('div');
	
	$tag->open('div','class="span10 offset1"');
		$tag->open('br');
	$tag->close('div');
endwhile;


?>