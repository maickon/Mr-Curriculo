<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class programacao extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'experiencia_programacao';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"linguagem" 		=> null,
				"conceito"	 		=> null,
				"aplicacao_feita" 	=> null,
				"descricao"			=> null
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>