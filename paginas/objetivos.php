<?php
function objetivos(){
	$tag = new tags();
	$objetivo = new objetivo();
	$objetivo->seleciona_tudo($objetivo);
	$tag->open('div','class="span9 offset2"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Objetivos');	
		$tag->close('h3');
	$tag->close('div');
	while($objetivo_resp = $objetivo->retorna_dados()):	
		$tag->open('div','class="span9 offset2"');
			apresentar_item_curriculo('', $objetivo_resp->texto);
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			$tag->open('br');
		$tag->close('div');
	endwhile;
	
	
}

?>