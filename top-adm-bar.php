<?php
	require_once 'init.php';
	inicializa();
	$sessao = new sessao();
	$meu_id = $sessao->getVar('id_user');
	$tag = new tags();
	menu_bar('Administração',
		 array(
		 	array('Usuários','Cadastrar','Exibir'),
			array('Experiências','Experiência academica','Experiência profissional','Experiência programação'),
			array('Eventos','Cadastrar novo evento','Exibir meus eventos'),
			array('Identificação','Cadastrar nova identificação','Exibir identificações'),
			array('Interesse','Cadastrar Interesse','Exibir interesses'),
			array('Objetivo','Cadastrar um objetivo','Exibir objetivos'),
			array('Projetos','Cadastrar um projeto','Exibir projetos'),
			array('Idiomas','Cadastrar um idioma','Exibir idiomas'),
			array('Apresentação','Cadastrar apresentação','Exibir Apresentação'),
			array('Páginas','Sobre o site','Visualizar minha página'),
			array('Sair','Alterar Senha','Sair')
		 ),
		 array(
		 	array('#','?m=usuario&t=incluir','?m=usuario&t=listar'),
		 	array('#','?m=exp_acm&t=listar','?m=exp_prof&t=listar','?m=exp_devl&t=listar'),
			array('#','?m=eventos&t=incluir','?m=eventos&t=listar'),
			array('#','?m=identificacao&t=incluir','?m=identificacao&t=listar'),
			array('#','?m=interesses&t=incluir','?m=interesses&t=listar'),
			array('#','?m=objetivos&t=incluir','?m=objetivos&t=listar'),
			array('#','?m=projetos&t=incluir','?m=projetos&t=listar'),
			array('#','?m=idiomas&t=incluir','?m=idiomas&t=listar'),
			array('#','?m=apresentacao&t=incluir','?m=apresentacao&t=listar'),
			array('#','?m=sobre&t=incluir','?m=sobre&t=listar'),
			array('#','?m=usuario&t=senha&id='.$meu_id.'','index.php?logoff=true')
			)
			);

?>