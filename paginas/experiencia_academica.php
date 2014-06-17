<?php
function experiencia_academica(){
	$ensino_medio = new academico();
	$ensino_medio->extras_select = "where curso='Ensino Médio'";
	$ensino_medio->seleciona_tudo($ensino_medio);
	$ensino_medio_resp = $ensino_medio->retorna_dados();
	
	$tag = new tags();
	
	$tag->open('div','class="span9 offset2"');
		$tag->open('h3','class="panel titulo"');
			$tag->inprime('Experiência Acadêmica');
		$tag->close('h3');
		
		apresentar_item_curriculo('Graduado no: ', $ensino_medio_resp->curso);
		apresentar_item_curriculo('Escola: ', $ensino_medio_resp->instituicao);
		apresentar_item_curriculo('Ano: ', $ensino_medio_resp->ano_termino);
		apresentar_item_curriculo('Cidade: ', $ensino_medio_resp->local);
	$tag->close('div');
	
	$tag->open('div','class="span9 offset2"');
		$tag->open('hr');
	$tag->close('div');
	
	$tag->open('div','class="span9 offset2"');
		$ensino_superior = new academico();
		$ensino_superior->extras_select = "where curso='Bacharelado em Sistema de Informação'";
		$ensino_superior->seleciona_tudo($ensino_superior);
		$ensino_superior_resp = $ensino_superior->retorna_dados();
		
		apresentar_item_curriculo('Cursando: ', $ensino_superior_resp->curso);
		apresentar_item_curriculo('Instituição: ', $ensino_superior_resp->instituicao);
		$tag->open('br');
		apresentar_item_curriculo('Previsão de Término: ', $ensino_superior_resp->ano_termino);
		apresentar_item_curriculo('Cidade: ', $ensino_superior_resp->local);
		apresentar_item_curriculo('Site Oficial: ', $ensino_superior_resp->link_referencia);
		apresentar_item_curriculo('Periodo: ', $ensino_superior_resp->estagio);
	$tag->close('div');
	
	$tag->open('div','class="span9 offset2"');
		$tag->open('hr');
	$tag->close('div');
	
	$tag->open('div','class="span9 offset2"');
		$ensino_superior = new academico();
		$ensino_superior->extras_select = "where curso='Informática Básica e Avançada'";
		$ensino_superior->seleciona_tudo($ensino_superior);
		$ensino_superior_resp = $ensino_superior->retorna_dados();
		
		apresentar_item_curriculo('Curso: ', $ensino_superior_resp->curso);
		apresentar_item_curriculo('Instituição: ', $ensino_superior_resp->instituicao);
		apresentar_item_curriculo('Ano: ', $ensino_superior_resp->ano_termino);
		apresentar_item_curriculo('Cidade: ', $ensino_superior_resp->local);
	$tag->close('div');
	$tag->open('div','class="span9"');
		$tag->open('br');
	$tag->close('div');
}
?>