<?php 

	require_once 'conexao.php';
	require_once 'util.php';

	// Verifica se o email já foi cadastrado
	$email = $_POST['email'];

	$email_rc = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
	$email_rc->bindValue(':email', $email);
	$email_rc->execute();

	$verificaEmail = $email_rc->fetchAll(PDO::FETCH_OBJ);
	$linhas = $email_rc->rowCount();


	if ($linhas >= 1) {

		echo 2;

	}else{

		// Faz o cadastro se o email ainda não estiver cadastrado
		if ($_POST['senha'] == $_POST['confirmar_senha']) {

			$sql = $pdo->prepare("INSERT INTO usuarios (nome, sobrenome, email, endereco, ponto_de_referencia, senha) VALUES (:nome, :sobrenome, :email, :endereco, :ponto_de_referencia, :senha)");

			$sql->bindValue(':nome', $_POST['nome']);
			$sql->bindValue(':sobrenome', $_POST['sobrenome']);
			$sql->bindValue(':email', $_POST['email']);
			$sql->bindValue(':endereco', $_POST['endereco']);
			$sql->bindValue(':ponto_de_referencia', $_POST['ponto_de_referencia']);
			$sql->bindValue(':senha', geraHash($_POST['senha'], SALT));
			$sql->execute();

			echo 1;
			
		} else {
			echo 0;
		}

	}

	
 ?>