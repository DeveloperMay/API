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

	public $_consulta;

	function __construct(){

		$conexao = new Model_Bancodados_Conexao;
		$this->_conexao = $conexao->conexao();
	}

	function checkExistCliente($cli_codigo){

		/* VERIFICA SE O CLI_CODIGO EXISTE - SE O CLIENTE EXISTE */
		
		$con = $this->_conexao->prepare('
			SELECT
				cli_nome 
			FROM cliente 
			WHERE cli_codigo = :cli_codigo
		');
		$con->bindParam(':cli_codigo', $cli_codigo);
		$con->execute();
		$fetch = $con->fetch(PDO::FETCH_ASSOC);
		$con = null;

		return $fetch;

	}
	
	function _checkTokenAPI($POST){

		/* PRECISAMOS DO CLI_CODIGO PARA PROSEGUIR NA API */
		if(!isset($POST['cli_codigo'])){

			echo json_encode(array('erro' => 403, 'res' => 'no', 'data' => 'Eu preciso saber qual é o código do cliente..'));
			exit;
		}
		
		/* VERIFICA SE EXISTE ESTE CLIENTE NA API */
		$clienteExiste = $this->checkExistCliente($POST['cli_codigo']);

		/* SE O CLIENTE NÃO EXISTIR, RETORNA ERRO, NÃO PODE FAZER NADA NA API SEM O CLIENTE IDENTIFICADO */
		if($clienteExiste === false){

			echo json_encode(array('res' => 'no', 'data' => 'Huumm, me parece que você não tem acesso a essa API.'));
			exit;
		}

	}
}