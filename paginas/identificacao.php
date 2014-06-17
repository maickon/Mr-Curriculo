<?php
function identificacao(){
	$identificacao = new identificacao();
	$identificacao->seleciona_tudo($identificacao);
	$identificacao_resp = $identificacao->retorna_dados();
	$tag = new tags();	
	$tag->open('div','class="span9 offset2"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Identificaчуo');
		$tag->close('h3');
		
		apresentar_item_curriculo('Nome: ', $identificacao_resp->nome);
		apresentar_item_curriculo('Cidade: ', $identificacao_resp->cidade);
		apresentar_item_curriculo('Estado: ', $identificacao_resp->uf);
		apresentar_item_curriculo('Cep: ', $identificacao_resp->cep);
		apresentar_item_curriculo('Rua: ', $identificacao_resp->rua);
		apresentar_item_curriculo('Bairro: ', $identificacao_resp->bairro);
		$tag->open('br');
		apresentar_item_curriculo('E-mail: ', $identificacao_resp->email);
		apresentar_item_curriculo('Telefone: ', $identificacao_resp->telefone);
		apresentar_item_curriculo('Nacionalidade: ', $identificacao_resp->nacionalidade);
		apresentar_item_curriculo('Naturalidade: ', $identificacao_resp->naturalidade);
		$tag->open('br');
		apresentar_item_curriculo('Estado Civil: ', $identificacao_resp->estado_civil);
		apresentar_item_curriculo('Data de nascimento: ', $identificacao_resp->nascimento);
	$tag->close('div');
	$tag->open('div','class="span9"');
		$tag->open('br');
	$tag->close('div');
}

function foto(){
	$identificacao = new identificacao();
	$identificacao->seleciona_tudo($identificacao);
	$identificacao_resp = $identificacao->retorna_dados();
	$tag = new tags();
	
	$tag->open('div','class="span2"');
		$tag->open('img','src="'.BASEURL.IMGUSER.$identificacao_resp->img1.'" class="img-polaroid foto"');
	$tag->close('div');
}

?>