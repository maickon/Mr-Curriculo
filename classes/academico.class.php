<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class academico extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'experiencia_academica';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"curso" 			=> null,
				"local"	 			=> null,
				"instituicao" 		=> null,
				"ano_termino"		=> null,
				"link_referencia" 	=> null,
				"estagio"	 		=> null
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>