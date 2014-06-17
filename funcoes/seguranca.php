<?php
function antiInject($string){
	$string = preg_replace("/(from|select|insert|delet|where|drop table|show table|#|\*|--|\\\\)/i","",$string);
	$string = trim($string);//limpa espaços vazios
	$string = strip_tags($string);//tiras tags php e html
	if(!get_magic_quotes_gpc())
		$string = addslashes($string);//adiciona barras invertidas a uma string
	return $string;
}

function codificarSenha($senha){
	return md5($senha);
}

function isAdmin(){
	verificar_login();
	$sessao = new Sessao();
	$userAdmin = new usuarioAdmin(array(
			'tipo' => NULL,
	));
	$id_user = $sessao->getVar('id_user');
	$userAdmin->extras_select = " WHERE id=$id_user";
	$userAdmin->seleciona_campos($userAdmin);
	$resp = $userAdmin->retorna_dados();
	if($resp = $resp->tipo == 'administrador'):
		return TRUE;
	else:
		return FALSE;
	endif;
}

function verificar_login(){
	$sessao = new Sessao();
	if($sessao->getNvars()<=0 || $sessao->getVar('logado') != true):
	redireciona('index.php?erro=true');
	else:
	return true;
	endif;
}

function gerar_nome($imagem_atual,$ext = NULL){
	if($imagem_atual == ''):
		return '';
	else:
		preg_match("/.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem_atual, $ext);
		$nova_imagem = md5(uniqid(time())) . "." . $ext[1];
		return $nova_imagem;
	endif;
}
?>