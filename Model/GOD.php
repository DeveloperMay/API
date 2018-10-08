<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "14/08/2018",
	"MODEL": "GOD",
	"LAST EDIT": "08/10/2018",
	"VERSION":"0.0.43"
}
*/

class Model_God{

	public $_conexao;

	public $_agora = AGORA;

	public $_hoje = HOJE;

	public $_ip = IP;

	function __construct(){

		$conexao = new Model_Bancodados_Conexao;
		$this->_conexao = $conexao;
	}

	function _checkTokenAPI($POST){

		/* VERIFICA SE EXISTE O INDICE T (TOKEN)*/
		if(isset($POST->t)){

			/* TOKEN ERRADO DA API*/
			if($POST->t !== TOKEN_API){
				echo json_encode(array('res' => 'no', 'info' => 'Erro: Se para arranjar serviço está dando trabalho, imagina emprego.'));
				exit;
			}

		/* NÃO EXISTE TOKEN NA REQUISIÇÃO - FALSE */
		}else{

			echo json_encode(array('res' => 'no', 'info' => 'Erro: Se o Piauí se juntar com o Maranhão fica Piranhão?'));
			exit;
		}
	}
}