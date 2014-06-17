<?php
function interesses(){
	$tag = new tags();
	$interesses = new interesses();
	$interesses->seleciona_tudo($interesses);
	$tag->open('div','class="span9 offset2"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Áreas de interesse');	
		$tag->close('h3');
	$tag->close('div');
	while($interesses_resp = $interesses->retorna_dados()):	
		$tag->open('div','class="span9 offset2"');
			apresentar_item_curriculo('', $interesses_resp->area);
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			$tag->open('br');
		$tag->close('div');
	endwhile;
	
	
}

?>