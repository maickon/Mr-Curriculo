<?php
require_once 'classes/tags.class.php';
inicializa();
function inicializa(){
	$init = 1;
	$tag = new tags();
	if(file_exists(dirname(__FILE__).'/config.php')):
		require_once(dirname(__FILE__).'/config.php');
	else:
		$init = 0;
		$tag->open('div','class="alert-box alert"');
			die($tag->inprime('O Arquivode configura��o n�o foi inicializado, contate o adminstrador.','decode'));
		$tag->close('div');
	endif;

	if(!defined('BASEPATH') || !defined('BASEURL')):
		$init = 0;
		$tag->open('div','class="alert-box alert"');
			die($tag->inprime('Faltam configura��es b�sicas do sistema, contate o adminstrador.','decode'));
		$tag->close('div');
	endif;

	if($init == 1):
		$classes = array(
					'base.class',
					'banco.class',
					'sessao.class',
					'usuario.class',
					'usuarioAdmin.class',
					'tags.class',
					'academico.class',
					'profissional.class',
					'programacao.class',
					'eventos.class',
					'identificacao.class',
					'interesses.class',
					'objetivo.class',
					'projetos.class',
					'apresentacao.class',
					'idioma.class',
					'sobre.class'
				);
		_autoload($classes,CLASSESPATH);
		
		$funcoes = array(
				'arquivos',
				'inprimir',
				'loadModulos',
				'formularios',
				'loadPages',
				'menus',
				'seguranca',
				'rotas',
				'tratar_erros',
				'sliders',
				'blog',
				'tempo',
				'string',
				'loadItensPages',
				'apresentar_item_curriculo'
			);
		_autoload($funcoes,FUNCOESPATH);
	endif;

	if(isset($_GET['logoff']) == TRUE):
		$user = new usuarioAdmin();
		$user->logoff();
		exit;
	endif;
}

function load_class($className){	
	$pasta = opendir(CLASSESPATH);
	$classes = array();
	$i=0;
	while($p = readdir($pasta)):
		if($p != '.' and $p != '..'):
			$classes[$i] = $p;
			$i++;
		endif;
	endwhile;
	$arqClasse = $classes;
	for($i=0;$i<count($arqClasse);$i++):
		if($arqClasse[$i] == $className):
			//echo CLASSESPATH.$arqClasse[$i].'<br/>';
			require_once CLASSESPATH.$arqClasse[$i];
		else:
		endif;
	endfor;
}


function _autoload(array $list_file, $dir=''){
	$tag = new tags();
	if(!empty($dir)): 
		$dir_ = $dir;
	else:
		$tag->open('div','class="alert-box alert"');
			die($tag->inprime('Deret�rio de classe n�o definido no arquivo de configura��o, contate o adminstrador.','decode'));
		$tag->close('div');
	endif;
	for($c=0; $c<count($list_file); $c++):
		if(file_exists(BASEPATH.$dir_.$list_file[$c].'.php')):
			require_once(dirname(__FILE__).'/'.$dir_.$list_file[$c].'.php');
		else:
			$tag->open('div','class="alert-box alert"');
				die($tag->inprime('Diret�rio '.$list_file[$c].' inv�lido, contate o adminstrador.'));
			$tag->close('div');
		endif;
	endfor;
}

function limpar_campo_excluir($propriedade,$objeto){
	if($objeto):
		$campo=$objeto->$propriedade;
		return $campo;
	else:
		$campo='';
		return $campo;
	endif;
}

function protegeArquivo($nome_arquivo, $redir_para='index.php?p=adm&erro=3'){
	$url = $_SERVER["PHP_SELF"];
	if(preg_match("/$nome_arquivo/i", $url)):
	//redireciona para outra URL
	redireciona($redir_para);
	endif;
}//fim protegeArquivo
?>
