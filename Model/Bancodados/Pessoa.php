<?php
/*
{
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "08/10/2018",
	"MODEL": "Consultas / Pessoas",
	"LAST EDIT": "07/10/2018",
	"VERSION":"0.0.2"
}
*/
class Model_Bancodados_Pessoa{

	/* FUNÇÃO RESPONSAVEL POR SALVAR NOVA PESSOA */
	function addPessoa($dados){

		if(is_array($dados) and isset($dados['pes_nome']) and !empty($dados['pes_nome'])){

			/* VERIFICA SE JÁ EXISTE UMA PESSOA CADASTRADA COM ESTE NOME & WHATSAPP */
			$con = $this->_conexao->prepare('
				SELECT pes_nome, pes_whats FROM cad_pessoa WHERE pes_whats = :pes_whats and pes_nome = :pes_nome
			');
			$con->bindParam(':pes_whats', $dados['pes_whats']);
			$con->bindParam(':pes_nome', $dados['pes_nome']);
			$con->execute();
			$fetch = $con->fetch(PDO::FETCH_ASSOC);
			$con = null;

			/* SE EXISTIR, RETURN ERROR */
			if(is_array($fetch) and isset($fetch['pes_whats'])){

				return array('res' => 'no', 'data' => 'ERRO: Já existe um registro com este nome & Whatsapp!');

			/* SE NÃO EXISTIR, REGISTRA NOVA PESSOA DO DB */
			}else{
		
				$con = $this->_conexao->prepare('
					INSERT INTO cad_pessoa 
						(
							cli_codigo,
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
							:cli_codigo,
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
				$con->bindParam(':cli_codigo', $dados['cli_codigo']);
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

				/* SE NÃO HOUVE ERRO NO REGISTRO, RETURN OK */
				if($fetch === false){

					return array('res' => 'ok', 'data' => $fetch);
				}

				/* SE HOUVER ERRO RETURN NO */
				return array('res' => 'no', 'data' => 'ERRO: Tente novamente mais tarde');
			}
		}

		return array('res' => 'no', 'data' => 'ERRO: Algo de errado não está certo meu jovem...');
	}

	/* FUNÇÃO RESPONSÁVEL POR ALTERAR OS DADOS DA PESSOA */
	function altPessoa($dados){

		if(is_array($dados) and isset($dados['pes_codigo']) and is_numeric($dados['pes_codigo'])){

			$select = $this->checkPostTabela('pes_nome');

			/* VERIFICA SE A PESSOA REALMENTE EXISTE NO DB */
			$con = $this->_conexao->prepare('
				SELECT pes_codigo FROM cad_pessoa WHERE pes_codigo = :pes_codigo
			');
			$con->bindParam(':pes_codigo', $dados['pes_codigo']);
			$con->execute();
			$fetch = $con->fetch(PDO::FETCH_ASSOC);
			$con = null;

			/* SE A PESSOA EXISTIR, DE FATO PODE SER FEITO A ALTERAÇÃO */
			if(is_array($fetch) and isset($fetch['pes_codigo'])){

				$con = $this->_conexao->prepare('
					UPDATE cad_pessoa SET pes_nome = :pes_nome WHERE pes_codigo = :pes_codigo
				');
				$con->bindParam(':pes_nome', $dados['pes_nome']);
				$con->bindParam(':pes_codigo', $dados['pes_codigo']);
				$con->execute();
				$fetch = $con->fetch(PDO::FETCH_ASSOC);

				/* DEBUGG */
				$error = $con->errorInfo();
				if(isset($error[1]) and empty($error[1])){
					new de($error);
				}
				$con = null;

				/* SE A ALTERAÇÃO FOI FEITA COM SUCESSO, RETURN OK*/
				if($fetch == false){

					return array('res' => 'ok', 'data' => 'Feito! registro alterado!');
				}

				/* SE HOUVE FALHA NA ALTERAÇÃO, RETURN NO */
				return array('res' => 'no', 'data' => 'ERRO: Tente novamente mais tarde');

			/* A PESSOA INFORMADA (pes_codigo) NÃO EXISTE NO DB */
			}else{
		
				return array('res' => 'no', 'data' => 'ERRO: Este código de usuário não corresponde a nenhum no sistema!');
			}
		}

		return array('res' => 'no', 'data' => 'ERRO: Algo de errado não está certo meu bom...');
	}

	/* FUNÇÃO RESPONSÁVEL POR RETORNAR DADOS DAS PESSOAS */
	function getPessoas(){

		$select = $this->checkGet();

		/* CASO NÃO HÁ NENHUM PARAM POR URL, EXIBIR AS SEGUINTES COLUNAS */
		if($select == ''){
			$select = 'pes_nome, pes_telefone, pes_sexo, pes_email, pes_cpf, pes_rg, pes_whats, pes_codigo';
		}

		$order = $this->_util->basico($_GET['order'] ?? 'ASC');
		$by = $this->_util->basico($_GET['by'] ?? 'pes_nome');

		$con = $this->_conexao->prepare('
			SELECT 
				'.$select.'
			FROM view_cad_pessoa
			ORDER BY '.$by.' '.$order
		);
		$con->execute();
		$fetch = $con->fetchAll(PDO::FETCH_ASSOC);
		$con = null;

		/* RETORNA OQUE ENCONTROU DO DB */
		if(is_array($fetch) and count($fetch) > 0){

			return $fetch;
		}

		return array('res' => 'no', 'data' => 'Não há nenhum usuario!');
	}

	/* FUNÇÃO MONTA O SELECT (UNE AS COLUNAS) */
	protected function checkGet(){

		$pes_codigo = $this->checkGetTabela('pes_codigo');
		$pes_nome = $this->checkGetTabela('pes_nome');
		$pes_telefone = $this->checkGetTabela('pes_telefone');
		$pes_email = $this->checkGetTabela('pes_email');
		$pes_whats = $this->checkGetTabela('pes_whats');
		$pes_sexo = $this->checkGetTabela('pes_sexo');
		$pes_cpf = $this->checkGetTabela('pes_cpf');
		$pes_rg = $this->checkGetTabela('pes_rg');

		$select = $pes_codigo.$pes_nome.$pes_telefone.$pes_email.$pes_whats.$pes_sexo.$pes_rg.$pes_cpf;
		$select = trim($select, ', ');

		return $select;
	}

	/* FUNÇÃO QUE MONTA O POST PARA BIND PARAM */
	protected function checkPostTabela($coluna){
		$columm = '';
		if(isset($_POST[$coluna])){
			$columm = $coluna.' = :'.$coluna.', ';
		}

		return $columm;
	}

	/* FUNÇÃO RETORNA NOME DA COLUNA PASSADA POR GET PARA EXIBIR NA CONSULTA */
	protected function checkGetTabela($coluna){
		$columm = '';
		if(isset($_GET[$coluna])){
			$columm = $coluna.', ';
		}

		return $columm;
	}
}