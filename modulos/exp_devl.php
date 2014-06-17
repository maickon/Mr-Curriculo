<?php
require_once(dirname(dirname(__FILE__))."/init.php");
protegeArquivo(basename(__FILE__));
$tag = new tags();
$objeto = 'experiencia_programacao';
$classe = 'programacao';
$modulo = 'exp_devl';

$inputLabel = array('Linguagem de programa��o');
$inputName = array('linguagem');

$selectLabes1 = array('Em qual nivel de conhecimento voc� se julga nesta linguagem?');
$selectNames1 = array('conceito');
$selectOptions1 = array('Iniciante','B�sico','Experi�nte','Profissional','Expert');

$selectLabes2 = array('Alguma aplica��o feita com esta linguagem?');
$selectNames2 = array('aplicacao_feita');
$selectOptions2 = array('sim','n�o');

$textAreaLabel = array('Descricao');
$textAreaText = array('descricao');

$pagina_nome = 'Experi�ncia com linguagens. Aqui voc� informa sobre suas experi�ncias adquiridas na �rea durante sua vida.';
$descriacao= array('create'=>'Cadastrar uma nova linguagem.',
				   'edit'=>'Editando uma nova linguagem.',
				   'destroy'=>'Deletando uma nova linguagem.');

switch ($tela):
	case 'incluir':
		$tag->open('h2');
			$tag->inprime($descriacao['create']);
		$tag->close('h2');
		if(isset($_POST['cadastrar'])):
			$objeto = new $classe(array(
				"linguagem" 		=> $_POST['linguagem'],
				"conceito"	 		=> $_POST['conceito'],
				"aplicacao_feita" 	=> $_POST['aplicacao_feita'],
				"descricao"			=> $_POST['descricao']
			));
			$objeto->inserir($objeto);
			if($objeto->linhas_afetadas == 1):
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
	            
				input($inputLabel, $inputName);
				select($selectLabes1, $selectNames1, $selectOptions1);	
				select($selectLabes2, $selectNames2, $selectOptions2);
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
					$tag->inprime('Cadastrar nova experi�ncia');
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
                    $labels = array('Linguagem','Nivel','Alguma aplica��o?','Descri��o','A��es');
			 		ths($labels);
			 	$tag->close('tr');
				
			$tag->close('thead');			  
		$tag->close('tbody');
			
			$objeto = new $classe();
			$objeto->seleciona_tudo($objeto);
			while($resp = $objeto->retorna_dados()):
				$tag->open('tr');
					tds($resp->linguagem); 
					tds($resp->conceito);
					tds($resp->aplicacao_feita);
					tds($resp->descricao);
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
						"linguagem" 		=> $_POST['linguagem'],
						"conceito"	 		=> $_POST['conceito'],
						"aplicacao_feita" 	=> $_POST['aplicacao_feita'],
						"descricao"			=> $_POST['descricao']
					));
					$objeto->valor_pk = $id;
					$objeto->extras_select =  " WHERE id=$id";
					$objeto->seleciona_tudo($objeto);
					$resp = $objeto->retorna_dados();
					$objeto->atualizar($objeto);
					if($objeto->linhas_afetadas == 1):
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
				
				$inputValuesEdit = array($objeto_resp->linguagem);
				input($inputLabel, $inputName,$inputValuesEdit);
				select($selectLabes1, $selectNames1, $selectOptions1,true,$objeto_resp);
				select($selectLabes2, $selectNames2, $selectOptions2,true,$objeto_resp);
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
				
				$inputValuesEdit = array(limpar_campo_excluir('linguagem',$objeto_resp));
				
				input($inputLabel, $inputName,$inputValuesEdit,'disabled');
				select($selectLabes1, $selectNames1, $selectOptions1,$objeto_resp->conceito,'disabled');
				select($selectLabes2, $selectNames2, $selectOptions2,$objeto_resp->aplicacao_feita,'disabled');
				textArea($textAreaLabel, $textAreaText,$objeto_resp->descricao,'disabled');
				btExcluir($modulo);
			$tag->close('fieldset');
		$tag->close('form'); 	
        else:
        	printMsg('Voc� n�o tem permiss�o para acessar esta p�gina. <a href="#" onclik="history.back()">Voltar</a>','erro');
        endif;	
	break;	
endswitch;

?>