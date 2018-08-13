<?php

	require_once 'core/conexao.php';

	$sql = $pdo->prepare('DELETE FROM carrinho_temporario WHERE ID = :id');
	$sql->bindValue(':id', $_POST['prod']);
	$sql->execute();

	if ($sql) {
		echo 1;
	}else{
		echo 0;
	}

?>