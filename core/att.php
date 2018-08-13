<?php 
	
	session_start();
	require_once 'conexao.php';

	try {

		$sql = $pdo->prepare("UPDATE usuarios SET endereco = :endereco, ponto_de_referencia = :ponto_de_referencia WHERE ID = :id");

		$sql->bindValue(':endereco', $_POST['endereco']);
		$sql->bindValue(':ponto_de_referencia', $_POST['ponto_de_referencia']);
		$sql->bindValue(':id', $_SESSION['id']);
		$sql->execute();
		echo '<script>alert("Dados atualizados com sucesso!");window.location = "../conta.php";</script>';

	} catch (Exception $e) {
		echo '<script>alert("Senhas não conferem!");window.location = "../cadastro.php";</script>';
	}

 ?>