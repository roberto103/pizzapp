<?php 

	session_start();
	require_once 'conexao.php';

	$qtd = $_POST['quantidade'];
	$produto = $_POST['tipo_produto'];

	// Se a quantidade for alterada para 0, o produto será deletado. Se não, a quantidade será alterada normalmente.
	if ($qtd <= 0) {

		$deleta = $pdo->prepare('DELETE FROM carrinho_temporario WHERE temporario_produto = :tp');
		$deleta->bindValue(':tp', $produto);
		$deleta->execute();

		if ($deleta) {
			echo 2;
		}else{
			echo 0;
		}

	}else{

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

	}

 ?>