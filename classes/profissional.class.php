<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class profissional extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'experiencia_profissional';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"funcao" 			=> null,
				"local_trabalho"	=> null,
				"data_inicio"		=> null,
				"data_fim"			=> null,
				"descricao" 		=> null
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>