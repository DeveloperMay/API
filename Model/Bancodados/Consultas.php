<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "14/08/2018",
	"MODEL": "Consultas",
	"LAST EDIT": "14/08/2018",
	"VERSION":"0.0.1"
}
*/
class Model_Bancodados_Consultas extends Model_Bancodados_Pessoa {

	public $_conexao;

	public $_util;

	public $_agora = AGORA;

	public $_hoje = HOJE;

	public $_ip = IP;

	public $_func;

	function __construct(){

		$conexao = new Model_Bancodados_Conexao;
		$this->_conexao = $conexao->conexao();

		$this->_util = new Model_Pluggs_Utilit;

		$this->_func = new Model_Functions_Functions;
	}

	function __destruct(){

		$this->_conexao = null;

		$this->_util = null;

		$this->_func = null;
	}

	function delUser($id){

		$con = $this->_conexao->prepare('
			DELETE FROM user WHERE id = :id
		');
		$con->bindParam(':id', $id);
		$con->execute();
		$fetch = $con->fetch(PDO::FETCH_ASSOC);
		$con = null;

		if($fetch == false){

			return array('res' => 'ok', 'data' => 'Feito! removido! =/');
		}

		return array('res' => 'no', 'data' => 'ERRO: Tente novamente mais tarde');
	}

	function addUser($nome, $idade){

		$con = $this->_conexao->prepare('
			SELECT nome FROM user WHERE nome = :nome
		');
		$con->bindParam(':nome', $nome);
		$con->execute();
		$fetch = $con->fetch(PDO::FETCH_ASSOC);
		$con = null;

		if(is_array($fetch) and isset($fetch['nome'])){

			return array('res' => 'no', 'data' => 'ERRO: Já existe um registro com este nome!');

		}else{

			$con = $this->_conexao->prepare('
				INSERT INTO user (nome, idade, ip, data, hora) VALUES (:nome, :idade, :ip, :data, :hora)
			');
			$con->bindParam(':nome', $nome);
			$con->bindParam(':idade', $idade);
			$con->bindParam(':ip', $this->_ip);
			$con->bindParam(':data', $this->_hoje);
			$con->bindParam(':hora', $this->_agora);
			$con->execute();
			$fetch = $con->fetch(PDO::FETCH_ASSOC);
			$con = null;

			if($fetch == false){

				return array('res' => 'ok', 'data' => 'Feito! registro salvo!');
			}

			return array('res' => 'no', 'data' => 'ERRO: Tente novamente mais tarde');
		}
	}

	function getUsers(){

		$con = $this->_conexao->prepare('
			SELECT id, nome, idade FROM user ORDER BY nome ASC
		');
		$con->execute();
		$fetch = $con->fetchAll(PDO::FETCH_ASSOC);
		$con = null;

		if(is_array($fetch) and count($fetch) > 0){

			return array('res' => 'ok', 'data' => $fetch);
		}

		return array('res' => 'no', 'data' => 'Não há nenhum usuario!');
	}
}