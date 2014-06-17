<?php
protegeArquivo(basename(__FILE__));
load_class('base.class.php');
class identificacao extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'identificacao';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"nome" 				=> null,
				"rua"	 			=> null,
				"numero" 			=> null,
				"cidade"			=> null,
				"bairro"			=> null,
				"uf" 				=> null,
				"cep" 				=> null,
				"email"	 			=> null,
				"telefone" 			=> null,
				"nacionalidade"		=> null,
				"naturalidade" 		=> null,
				"estado_civil"	 	=> null,
				"nascimento" 		=> null,
				"img1"				=> null
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
		
}//fim classe home

?>