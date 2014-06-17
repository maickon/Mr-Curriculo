<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class interesses extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'interesses';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"area" 			=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>