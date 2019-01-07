<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "14/08/2018",
		"CONTROLADOR": "Erro404",
		"LAST EDIT": "18/08/2018",
		"VERSION":"0.0.2"
	}
*/
class Erro404 {

	private $_cor;

	function __construct(){

		$this->_cor = new Model_GOD;
	}

	function index(){

		echo json_encode(array('res' => 'no', 'data' => 'Controlador não encontrado.'));
		exit;
	}
}