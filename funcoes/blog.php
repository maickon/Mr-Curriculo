<?php
function blog_status($objeto){
	$id = $objeto->blog_id;
	$blog_page = new blog_page();
	$blog_page->extras_select =  " WHERE id=$id";
	$blog_page->seleciona_tudo($blog_page);
	$resp = $blog_page->retorna_dados();
	
	return $resp;
}
?>