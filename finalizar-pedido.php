<?php
	
	session_start();
	include_once 'core/conexao.php';
	
	$sessao = $_SESSION['pedido'];
	$consulta = $pdo->prepare("SELECT * FROM carrinho_temporario WHERE temporario_sessao = :ses");
	$consulta->bindValue(':ses', $sessao);
	$consulta->execute();
	$linhas = $consulta->rowCount();
	
	foreach ($consulta as $mostra) {
		$produto_id = $mostra['temporario_produto'];
		$produto_nome = $mostra['temporario_nome'];
		$produto_quantidade = $mostra['temporario_quantidade'];
		$produto_preco = $mostra['temporario_preco'];
		$hora = date('H:i:s');
		
		$inserir = $pdo->prepare("INSERT INTO pedidos (produto_id, produto_nome, quantidade, preco, hora, sessao) VALUES (:produto_id, :produto_nome, :quantidade, :preco, :hora, :sessao)");
		$inserir->bindValue(':produto_id', $produto_id);
		$inserir->bindValue(':produto_nome', $produto_nome);
		$inserir->bindValue(':quantidade', $produto_quantidade);
		$inserir->bindValue(':preco', $produto_preco);
		$inserir->bindValue(':hora', $hora);
		$inserir->bindValue(':sessao', $sessao);
		$inserir->execute();

		echo "<script>alert('Pedido finalizado!');</script>";
		echo "<script>window.history.go(-1);</script>";
	}

?>