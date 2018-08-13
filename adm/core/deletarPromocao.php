<?php 
	
	session_start();
	require_once 'conexao.php';

	if (!empty($_GET['id'])) {

		$sql = $pdo->prepare("DELETE FROM promocoes WHERE id = :id");
		$sql->bindValue(':id', $_GET['id']);
		$sql->execute();

		if ($sql) {
			$_SESSION['msg_promo'] = '<div class="alert alert-success" role="alert">Promoção deletada com sucesso!</div>';
			header("Location: ../index.php");
		}else{
			$_SESSION['msg_promo'] = '<div class="alert alert-danger" role="alert">A promoção não foi deletado com sucesso!</div>';
			header("Location: ../index.php");
		}

	}else{
		$_SESSION['msg_promo'] = '<div class="alert alert-danger" role="alert">Selecione uma promoção para ser deletada!</div>';
		header("Location: ../index.php");
	}

 ?>