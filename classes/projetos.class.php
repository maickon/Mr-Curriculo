<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class projetos extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'projetos';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"titulo" 		=> NULL,
				"linguagem" 	=> NULL,
				"ano" 			=> NULL,
				"link" 			=> NULL,
				"texto" 		=> NULL,
				"img1" 			=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>