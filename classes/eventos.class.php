<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class eventos extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'eventos';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"evento" 			=> null,
				"ano"	 			=> null,
				"local" 			=> null,
				"descricao"			=> null,
				"img1"				=> null
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>