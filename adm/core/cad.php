<?php 

	require_once 'conexao.php';

	
	try {

		if ($_POST['senha'] == $_POST['confirmar_senha']) {

	    	$sql = $pdo->prepare("INSERT INTO adm (nome, email, senha) VALUES (:nome, :email, :senha)");

			$sql->bindValue(':nome', $_POST['nome']);
			$sql->bindValue(':email', $_POST['email']);
			$sql->bindValue(':senha', $_POST['senha']);
			$sql->execute();
			header('Location: ../admLogin.php');
			
		} else {
			echo '<script>alert("Senhas não conferem!");window.location = "../admCadastro.php";</script>';
		}
	}
	catch( PDOException $Exception ) {
	    echo '<script>alert("E-mail duplicado!");window.location = "../admCadastro.php";</script>';		
	}		

	
 ?>