<?php 

	session_start();
	require_once 'conexao.php';

	$qtd = $_POST['quantidade'];
	$produto = $_POST['tipo_produto'];

	$altera = $pdo->prepare('UPDATE carrinho_temporario SET temporario_quantidade = :val WHERE temporario_sessao = :ses AND temporario_produto = :tp');
	$altera->bindValue(':val', $qtd);
	$altera->bindValue(':ses', $_SESSION['pedido']);
	$altera->bindValue(':tp', $produto);
	$altera->execute();

	if ($altera) {
		echo 1;
	}else{
		echo 0;
	}

 ?>