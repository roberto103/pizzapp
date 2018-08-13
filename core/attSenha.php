<?php 
	
	session_start();
	require_once 'conexao.php';

	try {

		if ($_POST['senha'] == $_POST['confirmar_senha']) {
			$sql = $pdo->prepare("UPDATE usuarios SET senha = :senha WHERE ID = :id");

			$sql->bindValue(':senha', $_POST['senha']);
			$sql->bindValue(':id', $_SESSION['id']);
			$sql->execute();
			echo '<script>alert("Senha atualizada com sucesso!");window.location = "../conta.php";</script>';
		}else{
			echo '<script>alert("Senhas não conferem!");window.location = "../atualizarSenha.php";</script>';
		}

	} catch (Exception $e) {
		echo '<script>alert("Senhas não conferem!");window.location = "../atualizarSenha.php";</script>';
	}

 ?>