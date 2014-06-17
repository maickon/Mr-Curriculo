<?php
require_once(dirname(dirname(__FILE__))."/init.php");
protegeArquivo(basename(__FILE__));
$tag = new tags();
$objeto = 'identificacao';
$classe = 'identificacao';
$modulo = 'identificacao';

$inputLabel1 = array('Nome','Rua','Número','Cidade','Bairro');
$inputName1 = array('nome','rua','numero','cidade','bairro');

$inputLabel2 = array('Estado','E-mail','Telefone','Nacionalidade','Naturalidade');
$inputName2 = array('uf','email','telefone','nacionalidade','naturalidade');

$inputLabel3 = array('Estado Civil','Data de nascimento','Cep');
$inputName3 = array('estado_civil','nascimento','cep');

$inputLabel4 = 'Sua foto';
$inputName4 = 'arquivo1';


$pagina_nome = 'Eventos. Aqui você informa sobre os eventos em que já participou ao longo de sua vida.';
$descriacao= array('create'=>'Cadastrar um novo evento.',
				   'edit'=>'Editando um evento.',
				   'destroy'=>'Deletando um evento.');

switch ($tela):
	case 'incluir':
		$tag->open('h2');
			$tag->inprime($descriacao['create']);
		$tag->close('h2');
		if(isset($_POST['cadastrar'])):
			$objeto = new $classe(array(
				"nome" 			=> $_POST['nome'],
				"rua"			=> $_POST['rua'],
				"numero"	 	=> $_POST['numero'],
				"cidade"		=> $_POST['cidade'],
				"bairro"		=> $_POST['bairro'],
				"uf" 			=> $_POST['uf'],
				"cep" 			=> $_POST['cep'],
				"email"			=> $_POST['email'],
				"telefone"	 	=> $_POST['telefone'],
				"nacionalidade"	=> $_POST['nacionalidade'],
				"naturalidade" 	=> $_POST['naturalidade'],
				"estado_civil"	=> $_POST['estado_civil'],
				"nascimento"	=> $_POST['nascimento'],
				"img1"			=> (isset($_FILES['arquivo1']['name'])?gerar_nome($_FILES['arquivo1']['name']):'')
			));
			$objeto->inserir($objeto);
			if($objeto->linhas_afetadas == 1):
				upload_files($objeto,IMGUSER);
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
	            
				$tag->open('div','class="span3"');
					input($inputLabel1, $inputName1);
				$tag->close('div');
				
				$tag->open('div','class="span3"');
					input($inputLabel2, $inputName2);
				$tag->close('div');
				
				$tag->open('div','class="span3"');
					input($inputLabel3, $inputName3);
					input_file($inputLabel4, $inputName4);
				$tag->close('div');
				
				$tag->open('div','class="span12"');
					btCadastrar($modulo);
				$tag->close('div');
	        $tag->close('fieldset');
	    $tag->close('form');
	$tag->close('div');
	break;	
	
	case 'listar':
		$tag->open('div','align="right"');
			$tag->open('h2','align="left"');
				$tag->open('a','href="?m='.$modulo.'&t=incluir" title="Novo cadastro" class="link_incluir"');
					$tag->open('img','src="img/plus.png" alt="Novo cadastro"');
					$tag->inprime('Cadastrar uma nova identificação');
				$tag->close('a');
			$tag->close('h2'); 	
		$tag->close('div'); 
		?>
		<script type="text/javascript">
			$(document).ready(function(){
				$('#listausers').dataTable({
				"oLanguage":{
					"sLengthMenu": "Mostrar _MENU_ elementos por página",
					"sZeroRecords": "Nenhum dado encontrado para exibição",
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
                    $labels = array('Nome','Rua','Número','cidade','Bairro','Uf','Cep','E-mail','Telefone','Nacionalidade','Naturalidade','Estado Civil','Nascimento','Ações');
			 		ths($labels);
			 	$tag->close('tr');
				
			$tag->close('thead');			  
		$tag->close('tbody');
			
			$objeto = new $classe();
			$objeto->seleciona_tudo($objeto);
			while($resp = $objeto->retorna_dados()):
				$tag->open('tr');
					tds($resp->nome); 
					tds($resp->rua);
					tds($resp->numero);
					tds($resp->cidade);
					tds($resp->bairro);
					tds($resp->uf);
					tds($resp->cep);
					tds($resp->email);
					tds($resp->telefone);
					tds($resp->nacionalidade);
					tds($resp->naturalidade);
					tds($resp->estado_civil);
					tds($resp->nascimento);
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
						"nome" 			=> $_POST['nome'],
						"rua"			=> $_POST['rua'],
						"numero"	 	=> $_POST['numero'],
						"cidade"		=> $_POST['cidade'],
						"bairro"		=> $_POST['bairro'],
						"uf" 			=> $_POST['uf'],
						"cep" 			=> $_POST['cep'],
						"email"			=> $_POST['email'],
						"telefone"	 	=> $_POST['telefone'],
						"nacionalidade"	=> $_POST['nacionalidade'],
						"naturalidade" 	=> $_POST['naturalidade'],
						"estado_civil"	=> $_POST['estado_civil'],
						"nascimento"	=> $_POST['nascimento'],
						"img1"			=> (isset($_FILES['arquivo1']['name'])?gerar_nome($_FILES['arquivo1']['name']):'')
					));
					$objeto->valor_pk = $id;
					$objeto->extras_select =  " WHERE id=$id";
					$objeto->seleciona_tudo($objeto);
					$resp = $objeto->retorna_dados();
					$objeto->atualizar($objeto);
					if($objeto->linhas_afetadas == 1):
						delete_files($resp,IMGUSER,$resp->img1);
						upload_files($objeto,IMGUSER);
						printMsg('Dados editados com sucesso. <a href="?m='.$modulo.'&t=listar">Exibir página</a>');
						unset($_POST);
					else:
						printMsg('Nenhum dado foi alterado. <a href="?m='.$modulo.'&t=listar">Exibir página</a>','alerta');	
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
				
				$inputValuesEdit1 = array(
					$objeto_resp->nome,
					$objeto_resp->rua,
					$objeto_resp->numero,
					$objeto_resp->cidade,
					$objeto_resp->bairro
						);
			
				$inputValuesEdit2 = array(
					$objeto_resp->uf,
					$objeto_resp->email,
					$objeto_resp->telefone,
					$objeto_resp->nacionalidade,
					$objeto_resp->naturalidade
						);
				$inputValuesEdit3 = array(
					$objeto_resp->estado_civil,
					$objeto_resp->nascimento,
					$objeto_resp->cep
						);
				$tag->open('div','class="span3"');
					input($inputLabel1, $inputName1, $inputValuesEdit1);
				$tag->close('div');
				
				$tag->open('div','class="span3"');
					input($inputLabel2, $inputName2, $inputValuesEdit2);
				$tag->close('div');
				
				$tag->open('div','class="span3"');
					input($inputLabel3, $inputName3,$inputValuesEdit3);
					input_file($inputLabel4, $inputName4);
				$tag->close('div');
				
				$tag->open('div','class="span12"');
					btEditar($modulo);
				$tag->close('div');
				
				$tag->close('fieldset');
		$tag->close('form'); 
		else:
			printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
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
						printMsg('Dados deletados com sucesso. <a href="?m='.$modulo.'&t=listar">Exibir página</a>');
						unset($_POST);
					else:
						printMsg('Nenhum dado foi deletado. <a href="?m='.$modulo.'&t=listar">Exibir página</a>','alerta');	
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
				
				$inputValuesEdit1 = array(
					limpar_campo_excluir('nome',$objeto_resp),
					limpar_campo_excluir('rua',$objeto_resp),
					limpar_campo_excluir('numero',$objeto_resp),
					limpar_campo_excluir('cidade',$objeto_resp),
					limpar_campo_excluir('bairro',$objeto_resp)
						);
			
				$inputValuesEdit2 = array(
					limpar_campo_excluir('uf',$objeto_resp),
					limpar_campo_excluir('email',$objeto_resp),
					limpar_campo_excluir('telefone',$objeto_resp),
					limpar_campo_excluir('nacionalidade',$objeto_resp),
					limpar_campo_excluir('naturalidade',$objeto_resp)
						);
				$inputValuesEdit3 = array(
					limpar_campo_excluir('estado_civil',$objeto_resp),
					limpar_campo_excluir('nascimento',$objeto_resp),
					limpar_campo_excluir('cep',$objeto_resp)
						);
				$tag->open('div','class="span3"');
					input($inputLabel1, $inputName1, $inputValuesEdit1,'disabled');
				$tag->close('div');
				
				$tag->open('div','class="span3"');
					input($inputLabel2, $inputName2, $inputValuesEdit2,'disabled');
				$tag->close('div');
				
				$tag->open('div','class="span3"');
					input($inputLabel3, $inputName3,$inputValuesEdit3,'disabled');
					input_file($inputLabel4, $inputName4, null,'disabled');
				$tag->close('div');
				
				$tag->open('div','class="span12"');
					btExcluir($modulo);
				$tag->close('div');
			$tag->close('fieldset');
		$tag->close('form'); 	
        else:
        	printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
        endif;	
	break;	
endswitch;

?>