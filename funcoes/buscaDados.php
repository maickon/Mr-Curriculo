<?php

require_once '../classes/usuarioAdmin.class.php';
//busca valor digitado no campo autocomplete "$_GET['term']
$text = mysql_real_escape_string($_GET['term']);

$usuarios = new usuarioAdmin();
$usuarios->extras_select = "WHERE nome LIKE '%$text%' ORDER BY nome ASC";
$usuarios->seleciona_tudo($usuarios);

//formata o resultado para JSON
$json = '[';
$first = true;
while($resp = $usuarios->retorna_dados()):
	if (!$first) { $json .=  ','; } else { $first = false; }
	$json .= '{"value":"'.utf8_encode($resp->nome).'"}';
endwhile;
$json .= ']';

echo $json;

?>