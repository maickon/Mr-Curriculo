<?php
function printMsg($msg = NULL, $tipo = NULL){
	$tag = new tags();
	if($msg != NULL):
		switch($tipo):
			case 'erro':
				$tag->open('div','class="alert alert-error"');
					$tag->inprime($msg);
				$tag->close('div');
			break;
			case 'alerta':
				$tag->open('div','class="alert alert-block"');
					$tag->inprime($msg);
				$tag->close('div');
			break;
			case 'pergunta':
				$tag->open('div','class="alert alert-info"');
					$tag->inprime($msg);
				$tag->close('div');
			break;
			case 'secesso':
				$tag->open('div','class="alert alert-success"');
					$tag->inprime($msg);
				$tag->close('div');
			break;
			default:
				$tag->open('div','class="alert alert-success"');
					$tag->inprime($msg);
				$tag->close('div');
			break;
		endswitch;
	endif;
}

function apresentar_item_curriculo($label,$propiedade){
	$tag = new tags();
	if(isset($propiedade) && $propiedade != ''):
		$tag->open('strong');
			$tag->inprime($label);
		$tag->close('strong');
		$tag->inprime($propiedade);
	endif;
}
?>