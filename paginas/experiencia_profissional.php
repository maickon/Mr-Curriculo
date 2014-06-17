<?php
function experiencia_profissional(){
	$tag = new tags();
	$experiencia_profissional = new profissional();
	$experiencia_profissional->seleciona_tudo($experiencia_profissional);
	$tag->open('div','class="span9 offset2"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Experiкncia profissional');	
		$tag->close('h3');
	$tag->close('div');
	while($experiencia_profissional_resp = $experiencia_profissional->retorna_dados()):	
		$tag->open('div','class="span9 offset2"');
			apresentar_item_curriculo('Funзгo: ', $experiencia_profissional_resp->funcao);
			apresentar_item_curriculo('Local: ', $experiencia_profissional_resp->local_trabalho);
			$tag->open('br');
			apresentar_item_curriculo('Data de inнcio: ', $experiencia_profissional_resp->data_inicio);
			apresentar_item_curriculo('Data de tйrmino: ', $experiencia_profissional_resp->data_fim);
			$tag->open('br');
			apresentar_item_curriculo('Descriзгo: ', $experiencia_profissional_resp->descricao);
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			$tag->open('br');
		$tag->close('div');
	endwhile;
	
	
}

?>