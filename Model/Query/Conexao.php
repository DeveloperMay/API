<?php
/*
{
	"AUTHOR":"Matheus Maydana",
	"CREATED_DATA": "14/08/2018",
	"MODEL": "Conexao",
	"LAST EDIT": "14/08/2018",
	"VERSION":"0.0.1"
}
*/
class Model_Query_Conexao{

	function conexao(){

		try{

			$banco = BANCO_DADOS;
			if($banco == 'pgsql'){

				// POSTGRES
				$PDO = new PDO('pgsql:host='.DB_HOST.' dbname='.DB_NAME.' user='.DB_USER.' password='.DB_PASS.' port='.DB_PORT.'');
				return $PDO;

			}else{

				// MYSQL 
				$PDO = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.'', DB_USER, DB_PASS);
				return $PDO;
			}

		}catch(PDOException $e){

			return 'erro conexao';
			exit;
		}
	}
}

