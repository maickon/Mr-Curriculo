<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class objetivo extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'objetivo';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"texto" 		=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>