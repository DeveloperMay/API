<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "07/10/2018",
	"MODEL": "Consultas",
	"LAST EDIT": "07/10/2018",
	"VERSION":"0.0.1"
}
*/
class Model_Bancodados_Pessoa{

	function addPessoa($dados){

		if(is_array($dados) and isset($dados['pes_nome']) and !empty($dados['pes_nome'])){

			$con = $this->_conexao->prepare('
				SELECT pes_nome, pes_whats FROM cad_pessoa WHERE pes_whats = :pes_whats and pes_nome = :pes_nome
			');
			$con->bindParam(':pes_whats', $dados['pes_whats']);
			$con->bindParam(':pes_nome', $dados['pes_nome']);
			$con->execute();
			$fetch = $con->fetch(PDO::FETCH_ASSOC);
			$con = null;

			if(is_array($fetch) and isset($fetch['pes_whats'])){

				return array('res' => 'no', 'data' => 'ERRO: Já existe um registro com este nome & Whatsapp!');

			}else{
		
				$con = $this->_conexao->prepare('
					INSERT INTO cad_pessoa 
						(
							pes_nome,
							pes_nascimento, 
							pes_sexo,
							pes_telefone,
							pes_whats,
							pes_cpf,
							pes_rg,
							pes_email,
							pes_ip,
							pes_atualizacao,
							pes_criacao
						)
					VALUES
						(
							:pes_nome,
						 	:pes_nascimento, 
							:pes_sexo,
							:pes_telefone,
							:pes_whats,
							:pes_cpf,
							:pes_rg,
							:pes_email,
						 	:pes_ip,
							:pes_atualizacao,
							:pes_criacao
						)
				');
				$con->bindParam(':pes_nome', $dados['pes_nome']);
				$con->bindParam(':pes_nascimento', $dados['pes_nascimento']);
				$con->bindParam(':pes_sexo', $dados['pes_sexo']);
				$con->bindParam(':pes_telefone', $dados['pes_telefone']);
				$con->bindParam(':pes_whats', $dados['pes_whats']);
				$con->bindParam(':pes_cpf', $dados['pes_cpf']);
				$con->bindParam(':pes_rg', $dados['pes_rg']);
				$con->bindParam(':pes_email', $dados['pes_email']);
				$con->bindParam(':pes_ip', $this->_ip);
				$con->bindParam(':pes_atualizacao', $this->_agora);
				$con->bindParam(':pes_criacao', $this->_hoje);
				$con->execute();
				$fetch = $con->fetch(PDO::FETCH_ASSOC);

				/* DEBUGG */
				$error = $con->errorInfo();
				if(isset($error[1]) and empty($error[1])){
					new de($error);
				}
				$con = null;

				if($fetch == false){

					return array('res' => 'ok', 'data' => 'Feito! registro salvo!');
				}

				return array('res' => 'no', 'data' => 'ERRO: Tente novamente mais tarde');
			}
		}

		return array('res' => 'no', 'data' => 'ERRO: Dados não capsulados no array, preciso de um array! -_-');

	}

	function getPessoas(){


		$select = $this->checkGet();
		if($select == ''){
			$select = 'pes_nome, pes_telefone, pes_sexo, pes_email, pes_cpf, pes_rg, pes_whats';
		}

		$con = $this->_conexao->prepare('
			SELECT 
				'.$select.'
			FROM cad_pessoa ORDER BY pes_nome ASC
		');
		/*$con->bindParam(':pes_nome', $pes_nome);
		$con->bindParam(':pes_telefone', $pes_telefone);
		$con->bindParam(':pes_email', $pes_email);
		$con->bindParam(':pes_whats', $pes_whats);
		$con->bindParam(':pes_sexo', $pes_sexo);
		$con->bindParam(':pes_cpf', $pes_cpf);
		$con->bindParam(':pes_rg', $pes_rg);*/
		$con->execute();
		$fetch = $con->fetchAll(PDO::FETCH_ASSOC);
		$con = null;

		if(is_array($fetch) and count($fetch) > 0){

			return array('res' => 'ok', 'data' => $fetch);
		}

		return array('res' => 'no', 'data' => 'Não há nenhum usuario!');
	}

	protected function checkGet(){

		$pes_nome = $this->checkGetTabela('pes_nome');
		$pes_telefone = $this->checkGetTabela('pes_telefone');
		$pes_email = $this->checkGetTabela('pes_email');
		$pes_whats = $this->checkGetTabela('pes_whats');
		$pes_sexo = $this->checkGetTabela('pes_sexo');
		$pes_cpf = $this->checkGetTabela('pes_cpf');
		$pes_rg = $this->checkGetTabela('pes_rg');

		$select = $pes_nome.$pes_telefone.$pes_email.$pes_whats.$pes_sexo.$pes_rg.$pes_cpf;
		$select = trim($select, ', ');

		return $select;
	}

	protected function checkGetTabela($tabella){
		$tabela = '';
		if(isset($_GET[$tabella])){
			$tabela = $tabella.', ';
		}

		return $tabela;
	}

}