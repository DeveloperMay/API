<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "14/08/2018",
	"MODEL": "GOD",
	"LAST EDIT": "18/08/2018",
	"VERSION":"0.0.2"
}
*/

class Model_God{


	public $_conexao;

	function __construct(){

		$conexao = new Model_Bancodados_Conexao;
		$this->_conexao = $conexao;

		$this->_checkTokenAPI();
	}

	private function _checkTokenAPI(){

		if(isset($_GET['t'])){

			if($_GET['t'] !== TOKEN_API){
				echo json_encode(array('res' => 'no', 'info' => 'Erro: API Token inválido, seu vacilão'));
				exit;
			}

		}else{

			echo json_encode(array('res' => 'no', 'info' => 'Erro: Informe o token para acessar a API!'));
			exit;
		}
	}
}