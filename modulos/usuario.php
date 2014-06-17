<?php 
require_once(dirname(dirname(__FILE__))."/init.php");
protegeArquivo(basename(__FILE__));
$tag = new tags();
$pagina_nome = 'Usuário';
$objeto = 'user';
$classe = 'usuarioAdmin';
$modulo = 'usuario';

$inputLabels = array('Nome','E-mail','Login','Senha','Repita a senha');
$inputNames  = array('nome','email','login','senha','senhaconf');

$inputLabelsEdit = array('Nome','E-mail','Login');
$inputNamesEdit  = array('nome','email','login');

$selectLabes = array('Tipo de usuário');
$selectNames = array('tipo');
$selectOptions = array('administrador','cliente');

$selectLabes2 = array('Usuário ativo?');
$selectNames2 = array('ativo');
$selectOptions2 = array('sim','não');

$pagina_nome = 'Tela de cadastro de usuários';
$descriacao= array('create'=>'Novo usuário','edit'=>'Editar usuário','destroy'=>'Apagar usuário');

switch($tela):
	case 'login':
		$sessao = new sessao();
		if ($sessao->getNvars() > 0 && $sessao->getVar('logado') == TRUE && $sessao->getVar('ip') == $_SERVER['REMOTE_ADDR']) redireciona('painel-adm.php?m=true'); 
		if(isset($_POST['logar'])):
			$objeto = new $classe();
			$objeto->setValor('login',antiInject($_POST['usuario']));
			$objeto->setValor('senha',antiInject($_POST['senha']));
			if($objeto->logar($objeto)):
				redireciona('painel-adm.php?m=true');
			else:
				redireciona('?p=adm&erro=2');
			endif;
		endif;
		telaDeLogin();
        break;
        
        case 'incluir':
		$tag->open('h2');
			$tag->inprime($descriacao['create']);
		$tag->close('h2');
			if(isset($_POST['cadastrar'])):		
				$objeto = new $classe(array(
					'nome'=>$_POST['nome'],
					'email'=>$_POST['email'],
					'login'=>$_POST['login'],
					'tipo' =>NULL,
					'senha'=>codificarSenha($_POST['senha']),
					'ativo'=>'s',
					'tipo'=>$_POST['tipo'],	
					));
			if($objeto->usuJaExiste('login',$_POST['login'])):
				printMsg('Este login ja está cadastrado, escolha outro nome de usuário.','erro');
				$duplicado = TRUE;
			else:
				$duplicado = FALSE;
			endif;
			if($duplicado != TRUE):
				$objeto->inserir($objeto);
				if($objeto->linhas_afetadas == 1):
					printMsg('Dados inserido com sucesso <a href="'.BASEURL	.'?m='.$modulo.'&t=listar">Exibir cadastros</a>');
					unset($_POST);
				endif;
			endif;	
		endif;
	?>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".userForm").validate({
				rules:{
					nome:{required:true, minlength:3},	
					email:{required:true, email: true},
					login:{required:true, minlength:5},
					senha:{required:true, rangelength:[4,20]},
					senhaconf:{required:true,equalsTo:"#senha"},
					tipo:{required:true, tipo:true}
			}
		});
    });
    </script>
    <?php
    $tag->open('div','class="span12"');
    	$tag->open('form','class="userForm" method="post" action=""');
        	$tag->open('fieldset');
				$tag->open('legend');
					$tag->inprime($descriacao['create']);
				$tag->close('legend');
        	
				input($inputLabels, $inputNames);

				select($selectLabes, $selectNames, $selectOptions);
				
				btCadastrar($modulo);
      			        		 
    		$tag->close('fieldset');
    	$tag->close('form');
    $tag->close('div');
	break;

	case 'listar':
		$tag->inprime('<h2>Usuários cadastrados</h2>');
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
		$tag->open('table','cellspacing="0" cellpadding="0" border="0" class="display" id="listausers"');
			$tag->open('thead');
				$tag->open('tr');
				
				$ths = array('Nome','E-mail','Login','Tipo','Cadastrado','Usuário ativo?','Ações');
				ths($ths);
					
				$tag->close('tr');
			$tag->close('tr');
		$tag->close('thead');
		$tag->open('tbody'); 
			$objeto = new $classe();
			$objeto->seleciona_tudo($objeto);
			while($resp = $objeto->retorna_dados()):
				if($resp->tipo == 'administrador')$link = '<a href="?m='.$modulo.'&t=incluir" title="Novo cadastro"><img src="img/plus.png" alt="Novo cadastro" /></a> ';
				$tag->open('tr');
					tds($resp->nome);
					tds($resp->email);
					tds($resp->login);
					tds($resp->tipo);
					tds(date("d/m/Y",strtotime($resp->data_cadastro)));
					tds($resp->ativo);
					botoesCrud($resp->id, $modulo);
				$tag->close('tr');
			endwhile;
		$tag->close('tbody');
	$tag->close('table');
    break;

	case 'editar':
		$tag->inprime('<h2>Edição de usuários</h2>');
		$sessao = new sessao();
		if(isAdmin() == true || $sessao->getVar('id_user') == $_GET['id']):
			if(isset($_GET['id'])):
				$id = $_GET['id'];
				if(isset($_POST['editar'])):
					$objeto = new $classe(array(
						'nome' =>$_POST['nome'],
						'email' =>$_POST['email'],
						'login' =>$_POST['login'],
						'tipo' =>$_POST['tipo'],
						'ativo' =>$_POST['ativo']
					));
					$objeto->valor_pk = $id;
					$objeto->extras_select =  " WHERE id=$id";
					$objeto->seleciona_tudo($objeto);
					$resp = $objeto->retorna_dados();
					if(isset($duplicado) != TRUE):
						$objeto->atualizar($objeto);
						if($objeto->linhas_afetadas == 1):
							printMsg('Dados alterados com sucesso. <a href="?m='.$modulo.'&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum dado foi alterado. <a href="?m='.$modulo.'&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
				endif;
				
				$objeto_edit = new $classe();
				$objeto_edit->extras_select = " WHERE id=$id";
				$objeto_edit->seleciona_tudo($objeto_edit);
				$objeto_resp = $objeto_edit->retorna_dados();
			else:
				printMsg('Usuário não definido, <a href="m='.$modulo.'&t=listar">Escolha um usuário para alterar</a>','erro');
			endif;
			?>
			
			<script type="text/javascript">
			$(document).ready(function(){
				$(".userForm").validate({
					rules:{
						nome:{required:true, minlength:3},
						email:{required:true,email: true},
						tipo:{required:true, tipo:true},
						login:{required:true, minlength:5}
					}
				});
			});
			</script>
            <?php
            $tag->open('div','class="span12"');
				$tag->open('form','class="userForm custom" method="post" action=""');
					$tag->open('fieldset');
						$tag->open('legend');
							$tag->inprime($descriacao['edit']);
						$tag->close('legend');
						
						$inputValuesEdit = array($objeto_resp->nome,$objeto_resp->email,$objeto_resp->login,);
						input($inputLabelsEdit, $inputNamesEdit,$inputValuesEdit);
						select($selectLabes, $selectNames, $selectOptions,true,$objeto_resp);
						select($selectLabes2, $selectNames2, $selectOptions2,true,$objeto_resp);
						btEditar($modulo);	
					$tag->close('fieldset'); 
				$tag->close('form');
			$tag->close('div'); 
		else:
			printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
		endif;	
	break;	
				
	case 'senha':
		$tag->inprime('<h2>Edição de senha</h2>');
		$sessao = new sessao();
		if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
			if(isset($_GET['id'])):
				$id = $_GET['id'];
				if(isset($_POST['mudasenha'])):
					$objeto = new $classe(array(
						'senha'=>codificarSenha($_POST['senha']),
					));
					$objeto->valor_pk = $id;
					$objeto->extras_select =  " WHERE id=$id";
					$objeto->seleciona_tudo($objeto);
					$resp = $objeto->retorna_dados();
				
					$objeto->atualizar($objeto);
					if($objeto->linhas_afetadas == 1):
						printMsg('Senha alterada com sucesso. <a href="?m='.$modulo.'&t=listar">Exibir cadastros</a>');
						unset($_POST);
					else:
						printMsg('Nenhum dado foi alterado. <a href="?m='.$modulo.'&t=listar">Exibir cadastros</a>','alerta');	
					endif;
				endif;
				
				$objeto_edit = new $classe();
				$objeto_edit->extras_select = " WHERE id=$id";
				$objeto_edit->seleciona_tudo($objeto_edit);
				$objeto_resp = $objeto_edit->retorna_dados();
			else:
				printMsg('Usuário não definido, <a href="m='.$modulo.'&t=listar">Escolha um usuário para alterar</a>','erro');
			endif;
			?>
			
			<script type="text/javascript">
			$(document).ready(function(){
				$("#userForm").validate({
					rules:{
						login:{
							required:true, 
							minlength:5
							},
						senha:{
							required:true, 
							rangelength:[4,20]
							},
						senhaconf:{
							required:true,
							equalsTo:"#senha"
						}
					}
				});
			});
			</script>
		<?php 
		$tag->open('form','class="custom" id="userForm" method="post" action=""');
			$tag->open('fieldset');
				$tag->open('legend');
					$tag->inprime($descriacao['edit']);
				$tag->close('legend');
				
				$values = array(
				limpar_campo_excluir('nome',$objeto_resp),
				limpar_campo_excluir('email',$objeto_resp),
				limpar_campo_excluir('login',$objeto_resp));
				input($inputLabelsEdit, $inputNamesEdit,$values,'disabled');
				select($selectLabes, $selectNames, $selectOptions,true,$objeto_resp,'disabled');
			
				$inputLabelsSenha = array('Senha','Repita a senha');
				$inputNamesSenha  = array('senha','senhaconf');
				input($inputLabelsSenha, $inputNamesSenha);
							
				btAlterarSenha($modulo);
			$tag->close('fieldset'); 
		$tag->close('form');
		else:
			printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
		endif;	
	break;
	
	case 'excluir':
		$tag->inprime('<h2>Exclusão de usuários</h2>');
		$sessao = new sessao();
		if(isAdmin() == TRUE):
			if(isset($_GET['id'])):
				$id = $_GET['id'];
				if(isset($_POST['excluir'])):
					$objeto = new $classe();
					$objeto->valor_pk = $id;
					$objeto->extras_select = " WHERE id=$id";
					$objeto->seleciona_tudo($objeto);
					$resp = $objeto->retorna_dados();

					$objeto->deletar($objeto);				
					if($objeto->linhas_afetadas == 1):
						printMsg('Registro excluido com sucesso. <a href="?m='.$modulo.'&t=listar">Exibir cadastros</a>');
						unset($_POST);
					else:
						printMsg('Nenhum registro foi excluido. <a href="?m='.$modulo.'&t=listar">Exibir cadastros</a>','alerta');	
					endif;
				endif;
				
				$objeto_edit = new $classe();
				$objeto_edit->extras_select = " WHERE id=$id";
				$objeto_edit->seleciona_tudo($objeto_edit);
				$objeto_resp = $objeto_edit->retorna_dados();
			else:
				printMsg('Usuário não definido, <a href="m='.$modulo.'&t=listar">Escolha um usuário para excluir</a>','erro');
			endif;
			
			$tag->open('form','class="userForm custom" method="post" action=""');
				$tag->open('fieldset');
					$tag->open('legend');
						$tag->inprime($descriacao['destroy']);
					$tag->close('legend');
					$values = array(
					limpar_campo_excluir('nome',$objeto_resp),
					limpar_campo_excluir('email',$objeto_resp),
					limpar_campo_excluir('login',$objeto_resp));
					input($inputLabelsEdit, $inputNamesEdit,$values,'disabled');
					select($selectLabes, $selectNames, $selectOptions,true,$objeto_resp,'disabled');
					select($selectLabes2, $selectNames2, $selectOptions2,true,$objeto_resp,'disabled');
					btExcluir($modulo);										
			$tag->close('fieldset'); 
		$tag->close('form');
 
		else:
			printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
		endif;	
	break;
		
default:
		$tag->inprime('<p>A tela solicitada não existe.</p>');
	break;
endswitch;
?>