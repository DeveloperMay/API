<?php
/*
	{
		"AUTHOR":"Matheus Maydana",
		"CREATED_DATA": "14/08/2018",
		"CONTROLADOR": "Pessoa",
		"LAST EDIT": "08/10/2018",
		"VERSION":"0.0.3"
	}
*/
class Pessoa {

	private $_cor;

	private $_consulta;

	private $_method;

	private $_util;

	function __construct(){

		header('Access-Control-Allow-Origin: *');   
		header('Content-Type: application/json; charset=utf-8');
		header('Content-Type', 'application/json');
		header("Access-Control-Allow-Headers: Content-Type");
		$this->_cor = new Model_GOD;
		$this->_consulta = new Model_Bancodados_Consultas;
		$this->_util = new Model_Pluggs_Utilit;


		$this->_method = json_decode(file_get_contents('php://input'), true);

		//$json = json_decode(file_get_contents('php://input'), true);

	}

	function index(){

		/* EXIBE TODOS AS PESSOAS */
		echo json_encode($this->_consulta->getPessoas());
		exit;
	}

	function id(){

		/* CHECK TOKEN API */
		$this->_cor->_checkTokenAPI();

		/* EXIBE OS DADOS DE UM DETERMINADO USUÁRIO */
		if(isset($_GET['id']) and is_numeric($_GET['id'])){

			echo json_encode(array('res' => 'ok', 'data' => array('nome' => 'Matheus Lindo', 'idade' => '28')));
			exit;
		}
	}

	function del(){

		/* CHECK TOKEN API */
		$this->_cor->_checkTokenAPI();

		/* REMOVE UM USUARIO PELO ID DA CONTA */
		$json = json_decode(file_get_contents('php://input'), true);
		if(isset($json['id']) and is_numeric($json['id'])){
			$id = $this->_util->basico($json['id']);

			$remove = $this->_consulta->delUser($id);

			echo json_encode($remove);
			exit;			
		}
	}

	function alt(){

		$post = json_decode(file_get_contents('php://input', true));
		
		/* CHECK TOKEN API */
		$this->_cor->_checkTokenAPI($post);

		/* ALTERA UM USUARIO EXISTENTE*/
		if(isset($post->pes_codigo) and is_numeric($post->pes_codigo)){

			$dados = array();
			$dados['pes_codigo'] 		= $this->checkIsset($post, 'pes_codigo');
			$dados['pes_nome'] 			= $this->checkIsset($post, 'pes_nome');
			$dados['pes_sexo'] 			= $this->checkIsset($post, 'pes_sexo');
			$dados['pes_nascimento']	= $this->checkIsset($post, 'pes_nascimento');
			$dados['pes_telefone'] 		= $this->checkIsset($post, 'pes_telefone');
			$dados['pes_whats']	 		= $this->checkIsset($post, 'pes_whats');
			$dados['pes_cpf']	 		= $this->checkIsset($post, 'pes_cpf');
			$dados['pes_rg']	 		= $this->checkIsset($post, 'pes_rg');
			$dados['pes_email']	 		= $this->checkIsset($post, 'pes_email');

			$salva = $this->_consulta->altPessoa($dados);

			echo json_encode($salva);
			exit;			
		}

		echo json_encode(array('res' => 'no', 'data' => 'ERRO: Informe o código do usuário'));
		exit;
	}

	function add(){

		/* CHECK TOKEN API */
		$this->_cor->_checkTokenAPI($this->_method);


		/* ADD UM NOVO USUARIO */
		if(isset($this->_method['pes_nome'], $this->_method['pes_nascimento']) and !empty($this->_method['pes_nome']) and !empty($this->_method['pes_nascimento'])){

			$dados = array();
			$dados['cli_codigo'] 			= $this->checkIsset($this->_method, 'cli_codigo');
			$dados['pes_nome'] 			= $this->checkIsset($this->_method, 'pes_nome');
			$dados['pes_sexo'] 			= $this->checkIsset($this->_method, 'pes_sexo');
			$dados['pes_nascimento']	= $this->checkIsset($this->_method, 'pes_nascimento');
			$dados['pes_telefone'] 		= $this->checkIsset($this->_method, 'pes_telefone');
			$dados['pes_whats']	 		= $this->checkIsset($this->_method, 'pes_whats');
			$dados['pes_cpf']	 		= $this->checkIsset($this->_method, 'pes_cpf');
			$dados['pes_rg']	 		= $this->checkIsset($this->_method, 'pes_rg');
			$dados['pes_email']	 		= $this->checkIsset($this->_method, 'pes_email');
			$dados['pes_status']		= 1; // OFF

			$salva = $this->_consulta->addPessoa($dados);

			echo json_encode($salva);
			exit;			
		}

		echo json_encode(array('res' => 'no', 'data' => 'ERRO: Informe o usuário'));
		exit;
	}
	
	/* check POST */
	protected function checkIsset($post, $input){

		return $this->_util->basico($post[$input] ?? null);
	}
}