<?php
	require_once 'init.php';
	inicializa();
	$sessao = new sessao();
	$meu_id = $sessao->getVar('id_user');
	$tag = new tags();
	menu_bar('Administra��o',
		 array(
		 	array('Usu�rios','Cadastrar','Exibir'),
			array('Experi�ncias','Experi�ncia academica','Experi�ncia profissional','Experi�ncia programa��o'),
			array('Eventos','Cadastrar novo evento','Exibir meus eventos'),
			array('Identifica��o','Cadastrar nova identifica��o','Exibir identifica��es'),
			array('Interesse','Cadastrar Interesse','Exibir interesses'),
			array('Objetivo','Cadastrar um objetivo','Exibir objetivos'),
			array('Projetos','Cadastrar um projeto','Exibir projetos'),
			array('Idiomas','Cadastrar um idioma','Exibir idiomas'),
			array('Apresenta��o','Cadastrar apresenta��o','Exibir Apresenta��o'),
			array('P�ginas','Sobre o site','Visualizar minha p�gina'),
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