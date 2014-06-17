<?php
function idiomas(){
	$tag = new tags();
	$idiomas = new idioma();
	$idiomas->seleciona_tudo($idiomas);
	$tag->open('div','class="span9 offset2"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Idiomas');	
		$tag->close('h3');
	$tag->close('div');
	while($idiomas_resp = $idiomas->retorna_dados()):	
		$tag->open('div','class="span9 offset2"');
			apresentar_item_curriculo('Idioma:', $idiomas_resp->idioma);
			apresentar_item_curriculo('Nível de dominio (Iniciante,Básico,Experiênte,Profissional,Expert):', $idiomas_resp->nivel);
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			$tag->open('br');
		$tag->close('div');
	endwhile;
	
	
}

?>