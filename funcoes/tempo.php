<?php
function hora_atual(){
	$tempo = localtime(time(),TRUE);
	$hora = $tempo['tm_hour'];
	$min = $tempo['tm_min'];
	$segundos = $tempo['tm_sec'];

	return "$hora : $min : $segundos ";
}

function data_postagem($sessao,$data){
	$tempo = localtime(strtotime($data),TRUE);
	$dia = $tempo['tm_mday'];
	$mes = $tempo['tm_mon'];
	$ano = $tempo['tm_year']+1900;
	$semana = $tempo['tm_wday'];

	return "Escrito por <a>".$sessao."</a>, em ".$dia." de ". descobrir_mes($mes)." de $ano";
}

function data_comentario($sessao,$data){
	$tempo = localtime(strtotime($data),TRUE);
	$dia = $tempo['tm_mday'];
	$mes = $tempo['tm_mon'];
	$ano = $tempo['tm_year']+1900;
	$semana = $tempo['tm_wday'];

	return "No dia ".$dia." de ". descobrir_mes($mes)." de $ano, <a>".$sessao."</a> comentou este post.";
}

function descobrir_samana($dia){
	switch($dia):
		case 0:$semana = 'Domingo';
		break;
		case 1:$semana = 'Segunda feira';
		break;
		case 2:$semana = 'Terça feira';
		break;
		case 3:$semana = 'Quarta feira';
		break;
		case 4:$semana = 'Quinta feira';
		break;
		case 5:$semana = 'Sexta feira';
		break;
		case 6:$semana = 'Sábado';
		break;
		default:$semana = 'Erro, o parâmetro está incorreto';
	endswitch;
	return $semana;
}

function descobrir_mes($mes){
	switch($mes):
		case 0:$novo_mes = 'Janeiro';
		break;
		case 1:$novo_mes = 'Fevereiro';
		break;
		case 2:$novo_mes = 'Março';
		break;
		case 3:$novo_mes = 'Abril';
		break;
		case 4:$novo_mes = 'Maio';
		break;
		case 5:$novo_mes = 'Junho';
		break;
		case 6:$novo_mes = 'Julho';
		break;
		case 7:$novo_mes = 'Agosto';
		break;
		case 8:$novo_mes = 'Setembro';
		break;
		case 9:$novo_mes = 'Outubro';
		break;
		case 10:$novo_mes = 'Novembro';
		break;
		case 11:$novo_mes = 'Dezembro';
		break;
		default:$novo_mes = 'Erro, o parâmetro está incorreto';
	endswitch;
	return $novo_mes;
}

function formatar_data_string($data){
	if($data == ''):
		$data = '';
	else:
		$data = explode('/', $data);
		$data = "{$data[2]}-{$data[0]}-{$data[1]}";
	endif;
	return $data;
}

function retornar_data_atual(){
	$tempo = localtime(time(),TRUE);
	$dia = $tempo['tm_mday'];
	$mes = $tempo['tm_mon']+1;
	$ano = $tempo['tm_year']+1900;
	$atual_time = "$dia/$mes/$ano";
	$atual = explode('/', $atual_time);
	$atual = "{$atual[2]}-{$atual[1]}-{$atual[0]}";
	$atual = strtotime($atual);
	return $atual;
}

function retornar_data_final($data_inicio){
	$inicio = explode('/', $data_inicio);
	$inicio = "{$inicio[2]}-{$inicio[1]}-{$inicio[0]}";
	$final = strtotime($inicio . "+1 month");
	$fim = date('d/m/Y',$final);
	$fim = explode('/', $fim);
	//ou $fim = explode('/', date('d/m/Y',strtotime($inicio . "+1 month")));
	$fim = "{$fim[2]}-{$fim[1]}-{$fim[0]}";
	$fim = strtotime($fim);
	return $fim;
}


?>