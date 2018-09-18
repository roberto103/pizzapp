<?php

	$sessao = $_POST['sessao'];
	$status = $_POST['status'];

	$sql = $pdo->prepare('UPDATE pedidos SET status = :status WHERE sessao = :sessao');

	$sql->bindValue(':status', $status);
	$sql->bindValue(':id', $sessao);
	$sql->execute();

	if ($sql) {
		echo 1;
	}else{
		echo 0;
	}

 ?>