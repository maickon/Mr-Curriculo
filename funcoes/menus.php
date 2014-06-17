<?php
function menu_bar($site_nome,array $menus,array $links,$dropdown = 1){
	$tag = new tags();
	$sessao = new sessao();
	$tag->open('div','class="navbar navbar-fixed-top navbar-inverse"');
		$tag->open('div','class="navbar-inner"');
			$tag->open('div','class="container-modificado"');
				$tag->open('a','class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"');
					$tag->open('span','class="icon-bar"');
					$tag->close('span');
					
					$tag->open('span','class="icon-bar"');
					$tag->close('span');
					
					$tag->open('span','class="icon-bar"');
					$tag->close('span');
				$tag->close('a');
				
				$tag->open('a','class="brand" href="index.php"');
						$tag->inprime($site_nome);
				$tag->close('a');
				
				$tag->open('div','class="nav-collapse collapse navbar-responsive-collapse"');
				
					$tag->open('ul','class="nav"');
						for($m=0; $m<count($menus); $m++):					
							if($dropdown == 1)://identifica se é um drop down
								$tag->open('li','class="dropdown"');
									$tag->open('a','href="'.$links[$m][0].'" class="dropdown-toggle" data-toggle="dropdown"');
										$tag->inprime($menus[$m][0]);
										$tag->open('b','class="caret"');
										$tag->close('b');
									$tag->close('a');
									
									$tag->open('ul','class="dropdown-menu"');
										for($d=1; $d<count($menus[$m]); $d++):
											$tag->open('li');																	
												$tag->open('a','href="'.$links[$m][$d].'"');
													$tag->inprime($menus[$m][$d]);
												$tag->close('a');																				
											$tag->close('li');
										endfor;
									$tag->close('ul');
								$tag->close('li');
							else:
								for($m=0; $m<count($menus); $m++):									
									$tag->open('li');
										$tag->open('a','href="'.$links[$m].'"');
											$tag->inprime(($menus[$m]));
										$tag->close('a');
									$tag->close('li');					
								endfor;						
							endif;				
						endfor;
						
					$tag->close('ul');
										
				$tag->close('div');//nav-collapse collapse
					
			$tag->close('div');//container
		$tag->close('div');//navbar-inner
	$tag->close('div');//navbar navbar-fixed-top
}


function footer_bar(array $menus,array $links,$msg1='',$msg2=''){
	$tag = new tags();
	$tag->open('div','class="footer" align="center"');
		$tag->open('div','class="row"');
			$tag->open('br');
			$tag->open('br');
			for($m=0; $m<count($menus); $m++):
				$tag->inprime(' - ');
				$tag->open('a','href="'.BASEURL.'index.php?p='.$links[$m].'" class="footer-fonte"');
					$tag->inprime($menus[$m]);
				$tag->close('a');
	
				if($m == count($menus)-1):
					$tag->inprime(' - ');
					$tag->open('br');
					$tag->open('br');
					
					$tag->open('a','href="index.php" class="footer-fonte"');
						$tag->inprime($msg1);
					$tag->close('a');
					
					$tag->open('br');
					$tag->open('br');
					
					$tag->open('a','href="index.php" class="footer-fonte"');
						$tag->inprime($msg2);
					$tag->close('a');
					
					$tag->open('br');
					$tag->open('br');
				endif;
			endfor;
		$tag->close('div');
	$tag->close('div');
}


function logo_bar($img){
	$tag = new tags();
	$tag->open('div','class="'.rand_logo_bar().'"');
		$tag->open('div','class="row"');
			$tag->open('div','class="small-2 large-12 columns"');
				$tag->open('div','class="small-2 large-12 columns"');
					$tag->open('a','href="index.php"');
						$tag->open('img','src="'.$img.'"');
					$tag->close('a');
				$tag->close('div');
			$tag->close('div');
		$tag->close('div');
	$tag->close('div');
}

function paginacao(){
	$tag = new tags();
	$tag->open('div','class="large-12 columns push-5"');
		$tag->open('ul','class="pagination"');
			$tag->open('li','class="arrow unavailable"');
				$tag->open('a','href="#"');
					$tag->inprime('«');
				$tag->close('a');
			$tag->close('li');
	
			$tag->open('li','class="current"');
				$tag->open('a','href="#"');
					$tag->inprime('1');
				$tag->close('a');
			$tag->close('li');
			
			$tag->open('li');
				$tag->open('a','href="#"');
					$tag->inprime('2');
				$tag->close('a');
			$tag->close('li');
			
			$tag->open('li');
				$tag->open('a','href="#"');
					$tag->inprime('3');
				$tag->close('a');
			$tag->close('li');
			
			$tag->open('li','class="unavailable"');
				$tag->open('a','href="#"');
					$tag->inprime('...');
				$tag->close('a');
			$tag->close('li');
			
			$tag->open('li');
				$tag->open('a','href="#"');
					$tag->inprime('10');
				$tag->close('a');
			$tag->close('li');
			
			$tag->open('li');
				$tag->open('a','href="#"');
					$tag->inprime('11');
				$tag->close('a');
			$tag->close('li');
			
			$tag->open('li','class="arrow"');
				$tag->open('a','href="#"');
					$tag->inprime('»');
				$tag->close('a');
			$tag->close('li');
		$tag->close('ul');
	$tag->close('div');
}

function anuncio_menu($categoria='Categorias',$parceiros='Parceiros',$mais='Saiba mais &rarr;'){
	$tag = new tags();
	$tag->close('div');			
		$tag->open('aside','class="span3"');			
			$tag->open('h5');
				$tag->inprime($categoria);
			$tag->close('h5');
			
			$tag->open('ul','class="side-nav"');
			$listar = new blog_page();
			$listar->listar_categorias();
			while($objeto_resp = $listar->retorna_dados()):
				$tag->open('li');
					$tag->open('a','href="?p=blog&categoria='.$objeto_resp->categoria.'" class="link"');
						echo $objeto_resp->categoria;
					$tag->close('a');
				$tag->close('li');
			endwhile;	
			$tag->close('ul');
	
		$tag->open('div','class="well parceiros" align="left"');
		
			$tag->open('p');
				exibir_pagina_escolida('msg_anuncio','msg_anuncio','anuncio_mensalidade');
				$tag->open('a','href="#"');
					$tag->inprime($mais);
				$tag->close('a');
			$tag->close('p');
			$tag->open('h5');
				$tag->inprime($parceiros);
			$tag->close('h5');
			
			$tag->open('p');
				$parceiro = new parceiros();
				$parceiro->extras_select = "WHERE rand() ";
				$parceiro->seleciona_tudo($parceiro);
				while($resp = $parceiro->retorna_dados()):
					$tag->open('a','href="http://'.$resp->link.'"');
						$tag->open('img','src="'.PARCEIROSPATH.$resp->img1.'" class="img-polaroid img-logo" alt="'.$resp->nome.'"');
					$tag->close('a');	
				endwhile;
			$tag->close('p');
		$tag->close('div');
	$tag->close('aside');		
}

?>