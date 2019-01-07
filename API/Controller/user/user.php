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
class User {

	private $_cor;

	private $_json;

	function __construct(){

		header('Access-Control-Allow-Origin: *'); 
		header("Content-type: application/json; charset=utf-8");
		header('Content-Type', 'application/json');
		header("Access-Control-Allow-Headers: Content-Type");
		$this->_cor = new Model_GOD;
		$this->_consulta = new Model_Bancodados_Consultas;
		$this->_util = new Model_Pluggs_Utilit;

		$this->_json = json_decode(file_get_contents('php://input'), true);

	}

	function index(){


		/* EXIBE TODOS OS USUARIOS */
		echo json_encode($this->_consulta->getUsers());
		exit;
	}

	function id(){

		/* EXIBE OS DADOS DE UM DETERMINADO USUÁRIO */
		if(isset($_GET['id']) and is_numeric($_GET['id'])){

			echo json_encode(array('res' => 'ok', 'data' => array('nome' => 'Matheus Lindo', 'idade' => '28')));
			exit;
		}
	}

	function add(){

		$this->_cor->_checkTokenAPI($this->_json);

		/* ADD UM NOVO USUARIO */
		if(isset($this->_json['pes_nome'], $this->_json['pes_nascimento']) and !empty($this->_json['pes_nome']) and is_numeric($this->_json['pes_nascimento'])){
			$pes_nome 	= $this->_util->basico($this->_json['pes_nome']);
			$pes_nascimento 	= $this->_util->basico($this->_json['pes_nascimento']);

			$salva = $this->_consulta->addUser($pes_nome, $pes_nascimento);

			echo json_encode($salva);
			exit;			
		}

		echo json_encode(array('res' => 'no', 'data' => 'ERRO: informe o metodo para a request'));
		exit;
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

		echo json_encode(array('res' => 'no', 'data' => 'ERRO: Informe o usuário'));
		exit;
	}
}