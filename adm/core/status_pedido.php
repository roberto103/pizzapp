<?php 

	session_start();
	require_once 'conexao.php';

	$status = $_POST['status_pedido'];
	$sessao = $_POST['sessao'];

	$altera = $pdo->prepare('UPDATE pedidos SET status = :status WHERE sessao = :sessao');
	$altera->bindValue(':status', $status);
	$altera->bindValue(':sessao', $sessao);
	$altera->execute();

	if ($altera) {
		echo 1;
	}else{
		echo 0;
	}

 ?>