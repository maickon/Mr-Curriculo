<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class home_page extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'home_page';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"titulo" 			=> NULL,
				"texto" 			=> NULL,
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>