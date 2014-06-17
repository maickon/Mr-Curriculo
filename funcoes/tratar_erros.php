<?php
function erro_display($erro_id){
	$tag = new tags(); 
	$tag->open('br');
	$tag->open('br');
	$tag->open('div','class="row"');
		$tag->open('div','class="span4"');
			if(isset($erro_id)):
				$erro = $erro_id;
			else:
				$erro = '';
			endif;
			
			switch ($erro):
				case 1:
					$tag->inprime('<div class="alert alert-success">Você fez logoff do sistema.</div>');
				break;
				
				case 2:
					$tag->inprime('<div class="alert alert-error">Dados incorretos ou você não é um administrador.</div>');
					break;
				
				case 3:
					$tag->inprime('<div class="alert alert-error">Faça login de antes de acessar a página solicitada.</div>');
					break;
				
				case 4:
					$tag->inprime('<div class="alert">Cuidado!</div>');
					break;
				
				case 5:
					$tag->inprime('<div class="alert alert-info">Tenha atenção.</div>');
					break;
					endswitch;
		
		$tag->close('div');
	$tag->close('div');
}

?>