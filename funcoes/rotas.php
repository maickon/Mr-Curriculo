<?php

function rotear_pagina($pagina){
	if(isset($pagina)):
		switch($pagina):	
			case MODULOADM: loadModuo(MODULOUSUARIO,'login');
			break;
			
			case MODULOCLIENTE: loadModuo(MODULOUSUARIOCLIENTE,'login');
			break;
			
			case MODULOADMCLIENTE: loadModuo(MODULOUSUARIOCLIENTE,'incluir');
			break;
			
			case PAGEPROJETOS: loadPage(PROJETOS,'index');
			break;
			
			case PAGEEVENTOS: loadPage(EVENTOS,'index');
			break;
			
			case PAGESOBRE: loadPage(SOBRE,'index');
			break;
			
			default: loadPage('home_page','index');		
		endswitch;
	else:
		loadPage('home_page','index');
	endif;
}

function redireciona($url=''){
	header("Location:".$url);
}
?>