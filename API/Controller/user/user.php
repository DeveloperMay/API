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

	private $_method;

	function __construct(){

		header('Access-Control-Allow-Origin: *'); 
		header("Content-type: application/json; charset=utf-8");
		header("Access-Control-Allow-Methods", "GET, POST, OPTIONS, PUT, DELETE");
		header('Content-Type', 'application/json');

		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->_cor = new Model_GOD;
		$this->_consulta = new Model_Bancodados_Consultas;
		$this->_util = new Model_Pluggs_Utilit;

		//$json = json_decode(file_get_contents('php://input'), true);

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

		/* ADD UM NOVO USUARIO */
		if(isset($_POST['nome'], $_POST['idade']) and !empty($_POST['nome']) and is_numeric($_POST['idade'])){
			$nome 	= $this->_util->basico($_POST['nome']);
			$idade 	= $this->_util->basico($_POST['idade']);

			$salva = $this->_consulta->addUser($nome, $idade);

			echo json_encode($salva);
			exit;			
		}

		/* REMOVE UM USUARIO PELO ID DA CONTA */
		if(isset($_DELETE['id']) and is_numeric($_DELETE['id'])){
			$id = $this->_util->basico($_DELETE['id']);

			$remove = $this->_consulta->delUser($id);

			echo json_encode($remove);
			exit;			
		}
		echo json_encode(array('res' => 'no', 'data' => 'ERRO: Informe o usuário'));
		exit;
	}
}