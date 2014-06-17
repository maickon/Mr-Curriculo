<?php
function loadPage($page=NULL, $tela=NULL){
	if($page == NULL || $tela == NULL):
		echo utf8_decode('<p>Erro na função <strong>'.__FUNCTION__.'</strong> faltam parâmetros para execução.</p>');
	else:
		if(file_exists(BASEPATH.PAGEPATH."$page.php")):
			include_once(BASEPATH.PAGEPATH."$page.php");
		else:
			echo '<p>Página inexistente neste sistema.</p>';
		endif;
	endif;
}//fim loadPage

function exibir_pagina($objeto,$classe){
	$objeto = new $classe();
	$tag = new tags();
	$objeto->seleciona_tudo($objeto);
	while($objeto_resp = $objeto->retorna_dados()):
		$tag->inprime($objeto_resp->texto);
	endwhile;
}

function exibir_titulo($objeto,$classe){
	$objeto = new $classe();
	$tag = new tags();
	$objeto->seleciona_tudo($objeto);
	while($objeto_resp = $objeto->retorna_dados()):
		$tag->inprime($objeto_resp->titulo);
	endwhile;
}

?>