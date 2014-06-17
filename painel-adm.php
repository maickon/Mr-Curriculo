<!DOCTYPE html>
<!--[if IE 8]> 				 <html class="no-js lt-ie9" lang="en" > <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en" > <!--<![endif]-->
<?php
require('init.php');
inicializa();

if(isset($_GET['m'])) $modulo = $_GET['m'];
if(isset($_GET['t'])) $tela = $_GET['t'];

//protegeArquivo(basename(__FILE__)); loopde redirirecionamento
$tag = new tags();
$tag->open('html','lang="en"');
	$tag->open('head');
		//$tag->open('meta','http-equiv="Content-Type" content="text/html; charset=UTF-8"');
		//$tag->inprime('<link href="css/bootstrap/bootstrap.css" rel="stylesheet">');
		//$tag->inprime('<link href="css/bootstrap/bootstrap-responsive.css" rel="stylesheet">');
		$tag->loadCss();
		
		$tag->open('link','rel="stylesheet" href="css/data_table.css"');
		$tag->open('link','rel="stylesheet" href="css/bootstrap/bootstrap.css"');
		$tag->open('link','rel="stylesheet" href="css/bootstrap/bootstrap-responsive.css"');
		$tag->open('link','rel="stylesheet" href="css/jquery.autocomplete.css"');
				
		$tag->open('script','src="js/jquery.js"');					$tag->close('script');
		
		$tag->inprime('
				<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
   				<!--[if lt IE 9]>
     	 		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
   	 			<![endif]-->
				');
		//$tag->open('meta','charset="utf-8"');
		
		$tag->open('title');
			$tag->inprime(SITENAME);
		$tag->close('title');
		$tag->open('meta','name="viewport" content="width=device-width, initial-scale=1.0"');
		$tag->open('meta','name="description" content=""');
		$tag->open('meta','name="author" content=""');
		
		$tag->open('link','rel="shortcut icon" href="img/helpRpg.png"');
		$tag->open('link','rel="apple-touch-icon-precomposed" sizes="144x144" href="img/helpRpg.png"');
		$tag->open('link','rel="apple-touch-icon-precomposed" sizes="114x114" href="img/helpRpg.png"');
		$tag->open('link','rel="apple-touch-icon-precomposed" sizes="144x144" href="img/helpRpg.png"');
		$tag->open('link','rel="apple-touch-icon-precomposed" href="img/helpRpg.png"');
		
	$tag->close('head');

	$tag->open('body');
		require 'top-adm-bar.php';
		
		$tag->open('div','class="row corpo"');
			$tag->open('div','class="container"');
				if(isset($modulo) && isset($tela)):
					loadModuo($modulo,$tela);
				else:
					$tag->open('h1','align="center"');
						$tag->inprime('Painel administrativo - Meu Currículo.');
					$tag->close('h1');
					$tag->open('h4','align="center"');
						$tag->inprime('Selecione a opção desejada para dar inicio a administração do sistema.');
					$tag->close('h4');
				endif;	
			$tag->close('div');
		$tag->close('div');
		
		$tag->open('div','class="row cinza"');
			$tag->open('div');
				require('footer.php');
			$tag->close('div');
		$tag->close('div');
		
		$tag->inprime('<script src="js/jquery.js"></script>');
		$tag->inprime('<script src="js/jquery_datatables.js"></script>');
		$tag->inprime('<script src="ckeditor/ckeditor.js"></script>');
		$tag->inprime('<script src="js/jquery_validate.js"></script>');
		$tag->inprime('<script src="js/jquery_validate_messages.js"></script>');
		$tag->inprime('<script src="js/autocomplete.js"></script>');
		$tag->inprime('<script src="js/autocomplete.pack.js"></script>');
		$tag->inprime('<script src="js/autocomplete.min.js"></script>');
		
		$tag->inprime('<script src="js/bootstrap-transition.js"></script>');
		$tag->inprime('<script src="js/bootstrap-alert.js"></script>');
		$tag->inprime('<script src="js/bootstrap-modal.js"></script>');
		$tag->inprime('<script src="js/bootstrap-dropdown.js"></script>');
		$tag->inprime('<script src="js/bootstrap-scrollspy.js"></script>');
		$tag->inprime('<script src="js/bootstrap-tab.js"></script>');
		$tag->inprime('<script src="js/bootstrap-tooltip.js"></script>');
		$tag->inprime('<script src="js/bootstrap-popover.js"></script>');
		$tag->inprime('<script src="js/bootstrap-button.js"></script>');
		$tag->inprime('<script src="js/bootstrap-collapse.js"></script>');
		$tag->inprime('<script src="js/bootstrap-carousel.js"></script>');
		$tag->inprime('<script src="js/bootstrap-typeahead.js"></script>');
	$tag->close('body');
$tag->close('html');
?>