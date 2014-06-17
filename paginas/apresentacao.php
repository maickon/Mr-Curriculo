<?php
function apresentacao(){
	$tag = new tags();
	$apresentacao = new apresentacao();
	$apresentacao->seleciona_tudo($apresentacao);
	$tag->open('div','class="span9"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Apresentaчуo');	
		$tag->close('h3');
	$tag->close('div');
	while($apresentacao_resp = $apresentacao->retorna_dados()):	
		$tag->open('div','class="span9"');
			apresentar_item_curriculo('', $apresentacao_resp->texto);
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			$tag->open('br');
		$tag->close('div');
	endwhile;
	
	
}

?>