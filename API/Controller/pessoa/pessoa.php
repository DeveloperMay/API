<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "14/08/2018",
		"CONTROLADOR": "User",
		"LAST EDIT": "18/08/2018",
		"VERSION":"0.0.2"
	}
*/
class Pessoa {

	private $_cor;

	private $_consulta;

	private $_method;

	private $_util;

	function __construct(){

		header('Access-Control-Allow-Origin: *'); 
		header("Content-type: application/json; charset=utf-8");
		header('Content-Type', 'application/json');
		$this->_cor = new Model_GOD;
		$this->_consulta = new Model_Bancodados_Consultas;
		$this->_util = new Model_Pluggs_Utilit;

		$this->_method = json_decode(file_get_contents('php://input', true));
		//$json = json_decode(file_get_contents('php://input'), true);

	}

	function index(){


		/* EXIBE TODOS AS PESSOAS */
		echo json_encode($this->_consulta->getPessoas());
		exit;
	}

	function id(){

		/* EXIBE OS DADOS DE UM DETERMINADO USUÁRIO */
		if(isset($_GET['id']) and is_numeric($_GET['id'])){

			echo json_encode(array('res' => 'ok', 'data' => array('nome' => 'Matheus Lindo', 'idade' => '28')));
			exit;
		}
	}

	function del(){

		/* REMOVE UM USUARIO PELO ID DA CONTA */
		$json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['id']) and is_numeric($json['id'])){
			$id = $this->_util->basico($json['id']);

			$remove = $this->_consulta->delUser($id);

			echo json_encode($remove);
			exit;			
		}
	}

	/* check POST */
	protected function checkIsset($post, $input){

		return $this->_util->basico($post->$input) ?? null;
	}

	function add(){

		$post = json_decode(file_get_contents('php://input', true));
		/* ADD UM NOVO USUARIO */
		if(isset($post->pes_nome, $post->pes_telefone) and !empty($post->pes_nome) and is_numeric($post->pes_telefone)){

			$dados = array();
			$dados['pes_nome'] 			= $this->checkIsset($post, 'pes_nome');
			$dados['pes_sexo'] 			= $this->checkIsset($post, 'pes_sexo');
			$dados['pes_nascimento']	= $this->checkIsset($post, 'pes_nascimento');
			$dados['pes_telefone'] 		= $this->checkIsset($post, 'pes_telefone');
			$dados['pes_whats']	 		= $this->checkIsset($post, 'pes_whats');
			$dados['pes_cpf']	 		= $this->checkIsset($post, 'pes_cpf');
			$dados['pes_rg']	 		= $this->checkIsset($post, 'pes_rg');
			$dados['pes_email']	 		= $this->checkIsset($post, 'pes_email');
			$dados['pes_status']		= 1; // OFF

			$salva = $this->_consulta->addPessoa($dados);

			echo json_encode($salva);
			exit;			
		}

		echo json_encode(array('res' => 'no', 'data' => 'ERRO: Informe o usuário'));
		exit;
	}
}