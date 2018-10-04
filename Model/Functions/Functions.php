<?php
/*
	"AUTHOR":"Matheus Mayana",
	"CREATED_DATA": "14/08/2018",
	"MODEL": "Functions",
	"LAST EDIT": "18/08/2018",
	"VERSION":"0.0.2"
*/

class Model_Functions_Functions {

	/* GERA TOKEN DE SEGURAÇA NOS FORMULÁRIO */
	function _TokenForm($formulario){

		$token = $this->HASH(md5(uniqid(microtime(), true)));

		$_SESSION[$formulario.'_token'] = $token;

		return $token;
	}

	function _verificaToken($formulario, $send){

		/* $send = $_POST ou $_GET */
		if(!isset($_SESSION[$formulario.'_token'])){
			return false;
		}

		if(!isset($send) or empty($send)){
			return false;
		}

		if(isset($_SESSION[$formulario.'_token']) and $_SESSION[$formulario.'_token'] !== $send){
			return false;
		}

		return true;
	}

	/**
	** @see Cria o hash da senha, usando MD5 e SHA-1 + Salt
	** @param string
	** @return string
	**/

	function HASH($string){

		/**
		** @see NUNCA !!!!
		** @see NUNCA, JAMAIS, ALTERE O VALOR DA VARIÁVEL $salt
		**/
		$string = (string) $string;
		$salt = '31256578196*&%@#*(!$!+_%$(_+!%anpadfbahidpqwm,ksdpoqww[pqwṕqw[';

		return sha1(substr(md5($salt.$string), 5,25));
	}

	function addSession($key, $value){

		$_SESSION['login'][$key] = $value;
	}

	function checkPermission(){

		$id_cliente = null;
		$array = $_SESSION['login'] ?? array();
		foreach ($array as $id_conta => $info_conta){
			$id_cliente = $id_conta;
		}

		if($_SESSION['login'][$id_cliente]['acesso'] !== 6){

			/* Não tem permissão para acessar */
			header('location: /erro404');	
		};
	}

	function checkLogin(){

		/* SE NÃO TIVER SESSAO LOGIN, CAI FORA */
		if(!isset($_SESSION['login']) and empty($_SESSION['login'])){

			/* PRECISA ESTAR LOGADO PARA ENTRAR NO SISTEMA */
			header('location: /login');
		}

		/* SE EXISTIR A SESSÃO, VERIFICA SE EXISTE O DADO NO DB, SE NÃO TIVER LIMPA A SESSION */
		if(isset($_SESSION['login'])){

			$cliente = $this->_consulta->getInfoCliente('nome', key($_SESSION['login']));

			if($cliente === null){
				unset($_SESSION['login']);
			}
		}
	}
}