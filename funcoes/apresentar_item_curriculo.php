<?php
function logo($objeto){
	$tag = new tags();

	$tag->open('div','class="span2"');
		$tag->open('img','src="'.BASEURL.IMGPROJECT.$objeto->img1.'" class="img-polaroid foto"');
	$tag->close('div');
}

function logo_evento($objeto){
	$tag = new tags();

	$tag->open('div','class="span2"');
		$tag->open('img','src="'.BASEURL.IMGEVENTOS.$objeto->img1.'" class="img-polaroid foto"');
	$tag->close('div');
}

function projetos(){
	$tag = new tags();
	$projetos = new projetos();
	$projetos->seleciona_tudo($projetos);
	while($projetos_resp = $projetos->retorna_dados()):	
		logo($projetos_resp);
		$tag->open('div','class="span9"');
			$tag->open('h3','class="panel titulo"');
				$tag->inprime($projetos_resp->titulo);	
			$tag->close('h3');
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			apresentar_item_curriculo('Linguagem usada: ', $projetos_resp->linguagem);
			apresentar_item_curriculo('Data do projeto', $projetos_resp->ano);
			apresentar_item_curriculo('Endereчo do projeto: ', $projetos_resp->link);
			apresentar_item_curriculo('Descriчуo: ', $projetos_resp->texto);
		$tag->close('div');
		
		$tag->open('div','class="span11"');
			$tag->open('br');
		$tag->close('div');
	endwhile;	
}

function eventos(){
	$tag = new tags();
	$eventos = new eventos();
	$eventos->seleciona_tudo($eventos);
	while($eventos_resp = $eventos->retorna_dados()):
		logo_evento($eventos_resp);
		$tag->open('div','class="span9"');
			$tag->open('h3','class="panel titulo"');
				$tag->inprime($eventos_resp->evento);
			$tag->close('h3');
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			apresentar_item_curriculo('Ano: ', $eventos_resp->ano);
			apresentar_item_curriculo('Local:', $eventos_resp->local);
			$tag->open('br');
			apresentar_item_curriculo('Descriчуo: ', $eventos_resp->descricao);
			$tag->open('br');
		$tag->close('div');
		
		$tag->open('div','class="span9"');
			$tag->open('br');
		$tag->close('div');
	endwhile;
	
	
}

?>