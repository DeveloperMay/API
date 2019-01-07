<?php
/*
{
	"AUTHOR":"Matheus Maydana",
	"CREATED_DATA": "09/04/2018",
	"CONFIG": "Setting",
	"LAST EDIT": "22/07/2018",
	"VERSION":"0.0.9"
}
*/

/* DEBUG DESENVOLVIMENTO */
/**
TRUE = DESENVOLVIMENTO
FALSE = PRODUCAO (saveLogs);
**/
define('DEV', true);

/**
** CONFIGURAÇÕES DO MVC
**/
define('DIR', '../');

define('SUBDOMINIO', 'API/');

define('SUBDOMI', '');

define('SAVE_SESSIONS', 'Sessions');

define('DIR_CLASS', '');

/* USANDO HOST-VIRTUAL url é só /, no windows é ../mvc_maydana/ */
define('URL_STATIC', '/');

// Usado somente no windows - xampp /* USADO PELO CONTROLE DE MVCs que eu criei em casa */
define('DIRETORIO_PROJETO', DIR);		// diretório

/**
** CONFIGURAÇÕES
**/

define('LANGS', array(
		'br' => '',
		'en' => 'en'
	)
);
/**
** BANCO DADOS
** @param pgsql ou mysql
** @see demais dados em Model/Bancodados/Pssw
**/

define('BANCO_DADOS', 'pgsql');

define('ACTION', 'maydana_system');

define('URL_SITE', 'https://ff8c297e.ngrok.io/');

define('HOJE', date('d/m/Y'));

define('AGORA', date('H:i:s'));

define('IP', $_SERVER['REMOTE_ADDR']);

define('LAYOUT', 'layout');						// nome do layout (.html)

define('VERSION_MVC', '0.3.1'); 				// Version MVC

define('NOME_SISTEMA', '<span class="icon icon-evernote"></span> Maydana System');			// Nome Projeto

define('NOME_PROJETO', 'DevWeb - API');			// Nome Projeto

define('EXTENSAO_VISAO', '.html'); 				// Extenção das views

define('EXTENSAO_CONTROLADOR', '.php'); 		// Extenção das controllers


/**
** FUNÇÕES E MODELS
**/

define('HASH_PASSWORD', '123');

require_once '../MVC_Maydana.php';
new MVC_Maydana();