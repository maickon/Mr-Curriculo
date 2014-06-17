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
					$tag->inprime('<div class="alert alert-success">Voc� fez logoff do sistema.</div>');
				break;
				
				case 2:
					$tag->inprime('<div class="alert alert-error">Dados incorretos ou voc� n�o � um administrador.</div>');
					break;
				
				case 3:
					$tag->inprime('<div class="alert alert-error">Fa�a login de antes de acessar a p�gina solicitada.</div>');
					break;
				
				case 4:
					$tag->inprime('<div class="alert">Cuidado!</div>');
					break;
				
				case 5:
					$tag->inprime('<div class="alert alert-info">Tenha aten��o.</div>');
					break;
					endswitch;
		
		$tag->close('div');
	$tag->close('div');
}

?>