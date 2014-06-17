<?php
function retornarTudoAtendimento($objeto,$classe,$nome){
	$objeto = new $classe();
	$sql = "SELECT * FROM atendimento WHERE dentista='$nome'";
	$objeto->executaSQL($sql);
	return $objeto->retorna_dados();
}
?>