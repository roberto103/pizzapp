<?php 
	
	session_start();
	require_once 'conexao.php';

	if (!empty($_GET['prod_ID'])) {

		$sql = $pdo->prepare("DELETE FROM produtos WHERE prod_ID = :id");
		$sql->bindValue(':id', $_GET['prod_ID']);
		$sql->execute();

		if ($sql) {
			$_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produto deletado com sucesso!</div>';
			header("Location: ../index.php");
		}else{
			$_SESSION['msg'] = '<div class="alert alert-danger" role="alert">O produto não foi deletado com sucesso!</div>';
			header("Location: ../index.php");
		}

	}
	else{
		$_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Selecione um produto para ser deletado!</div>';
		header("Location: ../index.php");
	}

 ?>