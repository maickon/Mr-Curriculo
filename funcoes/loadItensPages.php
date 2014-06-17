<?php

function exibir_pagina_escolida($objeto,$classe,$nome){
	$objeto = new $classe();
	$objeto->extras_select = "WHERE nome='$nome'";
	$objeto->seleciona_tudo($objeto);
	while($objeto_resp = $objeto->retorna_dados()):
	echo utf8_decode($objeto_resp->texto);
	endwhile;
}


function exibir_historia($objeto,$classe,$id){
	$objeto = new $classe();
	$objeto->extras_select = "WHERE id=$id";
	$objeto->seleciona_tudo($objeto);
	while($objeto_resp = $objeto->retorna_dados()):
	echo utf8_decode($objeto_resp->texto);
	endwhile;
}


function ordenar_itens_de_pagina($objeto,$classe){
	$tag = new tags();
	$objeto = new $classe();
	$objeto->seleciona_tudo($objeto);

	$tag->open('ul');
	while($objeto_resp = $objeto->retorna_dados()):
	$tag->open('li');
	$tag->open('a','href="?p=historias_play&id='.$objeto_resp->id.'" class="link"');
	echo ($objeto_resp->titulo);
	$tag->close('a');
	$tag->close('li');
	endwhile;
	$tag->close('ul');
}

function voltar(){
	$tag = new tags();
	if($_GET['id']==1):
	$id = '';
	else:
	$id = $_GET['id']-1;
	endif;
	$tag->open('div','class="small-2 large-12 columns"');
	$tag->open('div','class="row"');
	$tag->open('a','href="?p=historias_play&id='.$id.'" class="link"');
	echo ('&bull;Voltar um item ');
	$tag->close('a');
		
	$tag->open('a','href="?p=historias_play" class="link"');
	echo ('&bull;Voltar ao indice');
	$tag->close('a');
	$tag->close('div');
	$tag->close('div');
}


?>