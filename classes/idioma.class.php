<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class idioma extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'idiomas';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"idioma" 		=> NULL,
				"nivel" 		=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>