<?php

function loadModuo($modulo=NULL, $tela=NULL){
	if($modulo == NULL || $tela == NULL):
		echo utf8_encode('<div class="alert alert-error">Erro na função <strong>'.__FUNCTION__.'</strong> faltam parâmetros para execução.</div>');
	else:
		if(file_exists(BASEPATH.MODULOSPATH."$modulo.php")):
			include_once(BASEPATH.MODULOSPATH."$modulo.php");
		else:
			echo BASEPATH.MODULOSPATH."$modulo.php";
			echo utf8_encode('<p>Módulo inexistente neste sistema.</p>');
		endif;
	endif;
}//fim loadModulo

?>