<?php
require_once(dirname(dirname(__FILE__))."/init.php");
protegeArquivo(basename(__FILE__));
$tag = new tags();
$objeto = 'projetos';
$classe = 'projetos';
$modulo = 'projetos';

$inputLabel = array('T�tulo','Linguagem','Link','Ano');
$inputName = array('titulo','linguagem','link','ano');

$textAreaLabel = array('Descricao');
$textAreaText = array('texto');

$pagina_nome = 'Projetos. Aqui voc� informa sobre todos os seus projetos de software que voc� desenvolveu.';
$descriacao= array('create'=>'Cadastrar um novo projeto.',
				   'edit'=>'Editando um projeto.',
				   'destroy'=>'Deletando um projeto.');

$inputLabel2 = 'Logomarca do projeto';
$inputName2 = 'arquivo1';

switch ($tela):
	case 'incluir':
		$tag->open('h2');
			$tag->inprime($descriacao['create']);
		$tag->close('h2');
		if(isset($_POST['cadastrar'])):
			$objeto = new $classe(array(
				"titulo" 		=> $_POST['titulo'],
				"linguagem" 	=> $_POST['linguagem'],
				"link"			=> $_POST['link'],
				"ano"	 		=> $_POST['ano'],
				"texto"			=> $_POST['texto'],
				"img1"			=> (isset($_FILES['arquivo1']['name'])?gerar_nome($_FILES['arquivo1']['name']):'')
			));
			$objeto->inserir($objeto);
			if($objeto->linhas_afetadas == 1):
				upload_files($objeto,IMGPROJECT);
				printMsg('Dados salvos com sucesso <a href="?m='.$modulo.'&t=listar">Exibir cadastros</a>');
				unset($_POST);
			endif;			
		endif;	
	
    $tag->open('div','class="span12"');
	    $tag->open('form','class="userForm" method="post" action="" enctype="multipart/form-data" ');
	        $tag->open('fieldset');
				$tag->open('legend');
					 $tag->inprime($pagina_nome);
				$tag->close('legend');
	            
				input_file($inputLabel2, $inputName2);
				input($inputLabel, $inputName);
				textArea($textAreaLabel, $textAreaText);
				btCadastrar($modulo);
				
	        $tag->close('fieldset');
	    $tag->close('form');
	$tag->close('div');
	break;	
	
	case 'listar':
		$tag->open('div','align="right"');
			$tag->open('h2','align="left"');
				$tag->open('a','href="?m='.$modulo.'&t=incluir" title="Novo cadastro" class="link_incluir"');
					$tag->open('img','src="img/plus.png" alt="Novo cadastro"');
					$tag->inprime('Cadastrar novo projeto.');
				$tag->close('a');
			$tag->close('h2'); 	
		$tag->close('div'); 
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#listausers').dataTable({
				"oLanguage":{
					"sLengthMenu": "Mostrar _MENU_ elementos por p�gina",
					"sZeroRecords": "Nenhum dado encontrado para exibi��o",
					"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ de registros",
					"sInfoEmpty": "Nenhum registro para ser exibido",
					"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
					"sSearch": "Pesquisar"
				}, 
					"sSrollY": "400px",
					"bPaginatc": false,
					"aaSorting": [[0, "asc"]]
				});
			});
		</script>
        <?php 
		$tag->open('table','cellspacing="0" cellpadding="0" border="0" class="display" id="listausers" ');
			$tag->open('thead');
			 	$tag->open('tr');
                    $labels = array('Nome do projeto','Linguagem utilizada','Ano','Link de refer�ncia','Descri��o','A��es');
			 		ths($labels);
			 	$tag->close('tr');
				
			$tag->close('thead');			  
		$tag->close('tbody');
			
			$objeto = new $classe();
			$objeto->seleciona_tudo($objeto);
			while($resp = $objeto->retorna_dados()):
				$tag->open('tr');
					tds($resp->titulo);
					tds($resp->linguagem);
					tds($resp->ano);
					tds($resp->link);
					tds($resp->texto);
					botoesCrud($resp->id, $modulo);
				$tag->close('tr');									
			endwhile;	
       $tag->close('tbody');	
	$tag->close('table');	

	break;	
		
	case 'editar':
		$tag->open('h2');
			echo ($descriacao['edit']);
		$tag->close('h2');	 
		if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
			if(isset($_GET['id'])):
				$id = $_GET['id'];
				if(isset($_POST['editar'])):
					$objeto = new $classe(array(
						"titulo" 		=> $_POST['titulo'],
						"linguagem" 	=> $_POST['linguagem'],
						"link"			=> $_POST['link'],
						"ano"	 		=> $_POST['ano'],
						"texto"			=> $_POST['texto'],
						"img1"			=> (isset($_FILES['arquivo1']['name'])?gerar_nome($_FILES['arquivo1']['name']):'')
					));
					$objeto->valor_pk = $id;
					$objeto->extras_select =  " WHERE id=$id";
					$objeto->seleciona_tudo($objeto);
					$resp = $objeto->retorna_dados();
					$objeto->atualizar($objeto);
					if($objeto->linhas_afetadas == 1):
						delete_files($resp,IMGPROJECT,$resp->img1);
						upload_files($objeto,IMGPROJECT);
						printMsg('Dados editados com sucesso. <a href="?m='.$modulo.'&t=listar">Exibir p�gina</a>');
						unset($_POST);
					else:
						printMsg('Nenhum dado foi alterado. <a href="?m='.$modulo.'&t=listar">Exibir p�gina</a>','alerta');	
					endif;
				endif;				
				$objeto_exibir = new $classe();
				$objeto_exibir->extras_select = " WHERE id=$id";
				$objeto_exibir->seleciona_tudo($objeto_exibir);
				$objeto_resp = $objeto_exibir->retorna_dados();
			endif;
	
		 $tag->open('form','class="userForm" method="post" action="" enctype="multipart/form-data" ');
			$tag->open('fieldset');
				$tag->open('legend');
					 $tag->inprime($pagina_nome);
				$tag->close('legend');
				
				$inputValuesEdit = array(
					$objeto_resp->titulo,
					$objeto_resp->linguagem,
					$objeto_resp->link,
					$objeto_resp->ano
						);
				input_file($inputLabel2, $inputName2);
				input($inputLabel, $inputName,$inputValuesEdit);
				textArea($textAreaLabel, $textAreaText,$objeto_resp);
				btEditar($modulo);
				
				$tag->close('fieldset');
		$tag->close('form'); 
		else:
			printMsg('Voc� n�o tem permiss�o para acessar esta p�gina. <a href="#" onclik="history.back()">Voltar</a>','erro');
		endif;
	break;	
	
	case 'excluir':
		$tag->open('h2');
			echo ($descriacao['destroy']);
		$tag->close('h2');
		$sessao = new sessao();
		if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
			if(isset($_GET['id'])):
				$id = $_GET['id'];
				if(isset($_POST['excluir'])):
					$objeto = new $classe(array());
					$objeto->valor_pk = $id;
					$objeto->extras_select =  " WHERE id=$id";
					$objeto->seleciona_tudo($objeto);
					$resp = $objeto->retorna_dados();
					
					$objeto->deletar($objeto);
					if($objeto->linhas_afetadas == 1):
						delete_files($resp,IMGPROJECT,$resp->img1);
						printMsg('Dados deletados com sucesso. <a href="?m='.$modulo.'&t=listar">Exibir p�gina</a>');
						unset($_POST);
					else:
						printMsg('Nenhum dado foi deletado. <a href="?m='.$modulo.'&t=listar">Exibir p�gina</a>','alerta');	
					endif;
				endif;
				$objeto_exibir = new $classe();
				$objeto_exibir->extras_select = " WHERE id=$id";
				$objeto_exibir->seleciona_tudo($objeto_exibir);
				$objeto_resp = $objeto_exibir->retorna_dados();
			endif;
			
		 $tag->open('form','class="userForm" method="post" action="" enctype="multipart/form-data" ');
			$tag->open('fieldset');
				$tag->open('legend');
					 $tag->inprime($pagina_nome);
				$tag->close('legend');
				
				$inputValuesEdit = array(
					limpar_campo_excluir('titulo',$objeto_resp),
					limpar_campo_excluir('ano',$objeto_resp),
					limpar_campo_excluir('link',$objeto_resp),
					limpar_campo_excluir('linguagem',$objeto_resp)
										);
			
				input($inputLabel, $inputName,$inputValuesEdit,'disabled');
				textArea($textAreaLabel, $textAreaText,$objeto_resp,'disabled');
				btExcluir($modulo);
			$tag->close('fieldset');
		$tag->close('form'); 	
        else:
        	printMsg('Voc� n�o tem permiss�o para acessar esta p�gina. <a href="#" onclik="history.back()">Voltar</a>','erro');
        endif;	
	break;	
endswitch;

?>