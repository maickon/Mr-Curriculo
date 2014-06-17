<?php
function criar_pasta($nome,$caminho = IMGGERALPATH){
	if(mkdir($caminho.$nome)):
		printMsg('Um arquivo com nome <b>'.$nome.'</b> foi criado com sucesso!');
	else:
		printMsg('Nenhum arquivo foi criado!','erro');
	endif;
}

function enviar_img($arquivo,$pasta,$caminho = IMGGERALPATH){
	if(move_uploaded_file($_FILES['arquivo']['tmp_name'],$caminho.$pasta.'/'.$_FILES['arquivo']['name'])):
		printMsg('Imagem <b>'.$_FILES['arquivo']['name'].'</b> enviada com sucesso');
	else:
		printMsg('Imagem não enviada!','erro');
	endif;
}

function ler_diretorio($nome,$caminho = IMGGERALPATH){
	$pasta = opendir($caminho.$nome);
	while($p = readdir($pasta)):
		if($p != '.' and $p != '..'):
			echo '|'.$p.' ';
		endif;
	endwhile;
}

function painel_upload($modulo){
	$tag = new tags();

	if(isset($_POST['enviar'])):
		enviar_img($_FILES['arquivo'],$_POST['pasta']);
	endif;

	if(isset($_POST['criar_pasta'])):
		criar_pasta($_POST['nome']);
	endif;

	$tag->open('div','class="span12"');
		$tag->open('div','class="row"');
			$tag->open('div','class="span5"');
				$tag->open('div','class="row"');
					$tag->open('form','class="userForm custom" method="post" action="" enctype="multipart/form-data" ');
						$tag->open('fieldset');
							$tag->open('legend');
								$tag->inprime('Craiar pasta');
							$tag->close('legend');
								
							$tag->open('label','for="nome"');
								$tag->inprime('Nome da pasta a ser criada:');
							$tag->close('label');
							$tag->open('input','type="text" size="50" name="nome" autofocus="autofocus" value=""');
								
							$tag->open('div','class="span12" align="left"');
								$tag->open('input','type="button" onclick="location.href=\'?m='.$modulo.'&t=listar\'" value="Cancelar" class="small button red"');
								$tag->inprime(' ');
								$tag->open('input','type="submit" name="criar_pasta" value="Criar Pasta" class="small button red"');
							$tag->close('div');
						$tag->close('fieldset');
					$tag->close('form');
				$tag->close('div');
			$tag->close('div');
								
			$tag->open('div','class="span6"');
				$tag->open('div','class="row"');
					$tag->open('form','class="userForm custom" method="post" action="" enctype="multipart/form-data" ');
						$tag->open('fieldset');
							$tag->open('legend');
								$tag->inprime('Upload de imagem');
							$tag->close('legend');
								
							$tag->open('label','for="pasta"');
								$tag->inprime('Selecione uma dessas pastas para fazer upload de uma foto:');
							$tag->close('label');
							$tag->open('select','id="customDropdown" name="pasta"');
								$pasta = opendir(IMGGERALPATH);
								while($p = readdir($pasta)):
									$tag->open('option');
										if($p != '.' and $p != '..'):
											$tag->inprime($p);
										endif;
									$tag->close('option');
								endwhile;
							$tag->close('select');
								
							$tag->open('label','for="arquivo"');
								$tag->inprime('Imagem a ser enviada:');
							$tag->close('label');
							$tag->open('input','type="file" size="50" name="arquivo" value=""');
								
							//$tag->open('div','class="span5" align="left"');
								$tag->open('input','type="button" onclick="location.href=\'?m='.$modulo.'&t=listar\'" value="Cancelar" class="small button red"');
								$tag->inprime(' ');
								$tag->open('input','type="submit" name="enviar" value="Enviar imagem" class="small button red"');
							//$tag->close('div');
						$tag->close('fieldset');
					$tag->close('form');
				$tag->close('div');
			$tag->close('div');
						
		$tag->close('div');
	$tag->close('div');
}

function prepare_file($file){
	if($file['name']!=''):
		return $file;
	else:
		return '';
	endif;
}

function exibir_campos_arquivos($qtd){
	$tag = new tags();
	if($qtd > 10):
		$qtd = 10;
	endif;
	for($i=1;$i<=$qtd;$i++):
		$tag->open('div','class="small-2 large-4 columns"');
			$tag->open('div','class="row"');
				$tag->open('label');
					$tag->inprime('Imagem n°'.$i.':');
				$tag->close('label');
				$tag->open('input','type="file" size="50" name="arquivo'.$i.'" value=""');
			$tag->close('div');
		$tag->close('div');
	endfor;
}

function upload($arquivo, $nome, $pasta){

	$_UP['pasta'] = $pasta;
	$_UP['tamanho'] = 1024*1024*2; // 2Mb
	$_UP['extencoes'] = array('jpg','png','gif');
	$_UP['renomeia'] = false;
	$_UP['erros'][0] = 'Não houve erros';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

	if($arquivo['error'] != 0):
		die('<div class="erro">Não foi possível fazer o upload, erro:<br />'.$_UP['erros'][$arquivo['error']].'</div>');
		exit;
	endif;
	
	$nome_arquivo = explode('.', $arquivo['name']);
	$extencao = strtolower(end($nome_arquivo));
	
	if(array_search($extencao,$_UP['extencoes'])=== false):
		echo '<div class="alerta">Por favor, envie arquivos com as seguintes extensões: jpg, png ou gif</div>';
	elseif($_UP['tamanho'] < $arquivo['size']):
		echo '<div class="alerta">O arquivo enviado é muito grande, envie arquivos de até 2Mb.</div>';
	endif;
	
	if(move_uploaded_file($arquivo['tmp_name'], $_UP['pasta'].$nome)):
		echo '<div class="sucesso">Upload efetuado com sucesso!</div>';
	else:
		echo '<div class="erro">Não foi possível enviar o arquivo, tente novamente</div>';
	endif;
}

function create_encrypt_file($caminho, $nome){
	if(mkdir($caminho.md5($nome))):
		printMsg('Um arquivo com nome <b>'.$nome.'</b> foi criado com sucesso!');
	else:
		printMsg('Nenhum arquivo foi criado!','erro');
	endif;
}

function upload_files($objeto,$caminho,$subpasta=false,$num_elementos=1){
	if($subpasta):
		for($i=1; $i<= $num_elementos; $i++):
			if($objeto->getValor('img'.$i) != ''):	
				upload($_FILES['arquivo'.$i], $objeto->getValor('img'.$i), $caminho.md5($objeto->getValor('img1')).'/');
			endif;
		endfor;
	else:
		for($i=1; $i<= $num_elementos; $i++):
			if($objeto->getValor('img'.$i) != ''):
				upload($_FILES['arquivo'.$i], $objeto->getValor('img'.$i), $caminho);
			endif;
		endfor;
	endif;
}

function delete_files($objeto,$caminho,$num_elementos=1){
	for($i=1; $i<= $num_elementos; $i++):
		$n = 'img'.$i;
		if(isset($objeto->$n) && $objeto->$n != ''):
			if(unlink($caminho.$objeto->$n)):
			else:
				printMsg('Arquivo não encontrado!','alerta');
			endif;
		endif;
	endfor;
}

function remove_dir($caminho){
	if(rmdir($caminho)):
		printMsg('Diretório deletado com sucesso!');
	else:
		printMsg('Diretório não foi deletado!','erro');
	endif;
}

function rand_logo_bar(){
	$pics = array ("logo1","logo2","logo3","logo4","logo5","logo6","logo7","logo8","logo9","logo10"
				   ,"logo11","logo12","logo13","logo14","logo15","logo16","logo17","logo18","logo19","logo20");
	$escolido = rand(0, count($pics)-1);
	return $pics[$escolido];
}

function slect_list(){		
	
	$escolido = rand(1,9);
		switch($escolido):
			case 1:
			$lista = Array('01.jpg','02.jpg','03.jpg','04.jpg','05.jpg','06.jpg',
						   '07.jpg','08.jpg','09.jpg','10.jpg','11.jpg','12.jpg');
			break;
			case 2:			   
			$lista = Array('17.jpg','18.jpg','19.jpg','20.jpg','21.jpg','22.jpg',
						   '23.jpg','24.jpg','25.jpg','26.jpg','27.jpg','28.jpg');
			break;
			case 3:			   
			$lista = Array('33.jpg','34.jpg','35.jpg','36.jpg','37.jpg','38.jpg',
						   '39.jpg','40.jpg','41.jpg','42.jpg','43.jpg','44.jpg');
			break;
			case 4:			   
			$lista = Array('49.jpg','50.jpg','51.jpg','52.jpg','53.jpg','54.jpg',
						   '55.jpg','56.jpg','57.jpg','33.jpg','34.jpg','01.jpg');
			break;
			case 5:			   
			$lista = Array('51.jpg','52.jpg','03.jpg','35.jpg','36.jpg','06.jpg',
						   '07.jpg','47.jpg','48.jpg','10.jpg','50.jpg','51.jpg');
			break;
			case 6:			   
			$lista = Array('47.jpg','48.jpg','03.jpg','04.jpg','05.jpg','06.jpg',
						   '07.jpg','08.jpg','46.jpg','47.jpg','11.jpg','12.jpg');
			break;
			case 7:
			$lista = Array('13.jpg','14.jpg','15.jpg','16.jpg','02.jpg','29.jpg',
							'51.jpg','52.jpg','13.jpg','14.jpg','15.jpg','16.jpg');
			break;
			case 8:				
			$lista = Array('45.jpg','46.jpg','47.jpg','48.jpg','02.jpg','29.jpg',
							'51.jpg','52.jpg','13.jpg','14.jpg','15.jpg','16.jpg');
			break;
			case 9:				
			$lista = Array('30.jpg','22.jpg','13.jpg','14.jpg','15.jpg','16.jpg',
							'29.jpg','30.jpg','31.jpg','32.jpg','51.jpg','52.jpg');
			break;
		endswitch;			
		
	return $lista;	
		
}

?>