<?php

	/** 
	* Esse script deve ser o primeiro 
	* required_once logo no 
	* início de cada arquivo.
	**/

	//Definição de fuso horário
	date_default_timezone_set('America/Recife');

	//Codificação da Página
	mb_internal_encoding('UTF-8');
	mb_http_output('UTF-8');

	//Constantes de acesso ao BD
	const HOST = '127.0.0.1';
	const DBNAME = 'pizzapp';
	const USER = 'root';
	const PASSWORD = '';

	//SALT utilizado para adicionar segurança aos hashes
	const SALT = 'natasha';

	//Conexão com o BD
	$pdo = new PDO("mysql:host=".HOST.";dbname=".DBNAME.";charset=utf8", 
		    	USER, PASSWORD);

    //Configura o PDO para gerar exceções e impedir o script de continuar.
    //Transações serão rolled back automaticamente em caso de erro.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Converte strings vazias para null
    $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);