<?php
function experiencia_programacao(){
	$tag = new tags();
	
	$experiencia_programacao = new programacao();
	$experiencia_programacao->seleciona_tudo($experiencia_programacao);
	$tag->open('div','class="span9 offset2"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Experiъncia com linguagens de programaчуo');
		$tag->close('h3');
	$tag->close('div');
	while($experiencia_programacao_resp = $experiencia_programacao->retorna_dados()):
		$tag->open('div','class="span9 offset2"');
			apresentar_item_curriculo('Linguagem: ', $experiencia_programacao_resp->linguagem);
			apresentar_item_curriculo('Nivel de conhecimento: (Iniciante, Bсsico, Experiъnte, Profissional e Expert)', $experiencia_programacao_resp->conceito);
			apresentar_item_curriculo('Aplicaчуo Feita: ', $experiencia_programacao_resp->aplicacao_feita);
			$tag->open('br');
			apresentar_item_curriculo('Descriчуo: ', $experiencia_programacao_resp->descricao);
			
			$tag->open('br');
		$tag->close('div');
	endwhile;
	
	
}

?>