<?php

require_once 'conexao.php';

abstract class Sessao
{
	
	function __construct()
	{
		
	}

	
	static function estaLogado()
	{
		session_start();

		if (!isset($_SESSION['email']) && !isset($_SESSION['email_adm'])) {
		    Sessao::logout();
		    return false;
		} else {
			return true;
		}
	}


	static function logout()
	{
		session_start();
		
	    $_SESSION['email'] = NULL;

	    unset ($_SESSION['email']);

	    session_destroy();
	}


	static function login($login,$senha)
	{
	$HOST = '127.0.0.1';
	$DBNAME = 'pizzapp';
	$USER = 'root';
	$PASSWORD = '';

	//SALT utilizado para adicionar segurança aos hashes
	$SALT = 'natasha';

	//Conexão com o BD
	$pdo = new PDO("mysql:host=".$HOST.";dbname=".$DBNAME.";charset=utf8", 
		    	$USER, $PASSWORD);

    //Configura o PDO para gerar exceções e impedir o script de continuar.
    //Transações serão rolled back automaticamente em caso de erro.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Converte strings vazias para null
    $pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);

		$handler = $pdo->prepare('SELECT * FROM usuarios WHERE email=:email AND senha=:senha');
		
		$handler->bindValue(':email',$login);
		$handler->bindValue(':senha',$senha);
		$handler->execute();
		$administrador = $handler->fetch(PDO::FETCH_OBJ);

		$logado = $handler->rowCount();

		if ($logado)
		{
			session_start();
     
		    $_SESSION['email'] = $administrador->email;

		    return true;
		} else {
			Sessao::logout();
			return false;
		}
	}
}