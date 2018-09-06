<?php
	
	session_start();
	include_once 'core/conexao.php';
	
	$sessao = $_POST['ref'];
	$consulta = $pdo->prepare("SELECT * FROM carrinho_temporario WHERE temporario_sessao = :ses");
	$consulta->bindValue(':ses', $sessao);
	$consulta->execute();
	$linhas = $consulta->rowCount();
	
	foreach ($consulta as $mostra) {
		$produto_id = $mostra['temporario_produto'];
		$produto_nome = $mostra['temporario_nome'];
		$produto_quantidade = $mostra['temporario_quantidade'];
		$produto_preco = $mostra['temporario_preco'];

		$valor_total = ($produto_quantidade * $produto_preco);
		$hora = date('H:i:s');

		@$descricao = $descricao . $produto_nome.' - '.$produto_quantidade.' Unidades </br>';

	}

	// Inseri o pedido na tabela de pedidos
	$inserir = $pdo->prepare("INSERT INTO pedidos (produto_id, produto_nome, descricao, quantidade, preco, valor_total, hora, sessao, status) VALUES (:produto_id, :produto_nome, :descricao, :quantidade, :preco, :valor_total, :hora, :sessao, :status)");
	$inserir->bindValue(':produto_id', $produto_id);
	$inserir->bindValue(':produto_nome', $produto_nome);
	$inserir->bindValue(':descricao', $descricao);
	$inserir->bindValue(':quantidade', $produto_quantidade);
	$inserir->bindValue(':preco', $produto_preco);
	$inserir->bindValue(':valor_total', $valor_total);
	$inserir->bindValue(':hora', $hora);
	$inserir->bindValue(':sessao', $sessao);
	$inserir->bindValue(':status', 'Aguardando atendimento');
	$inserir->execute();

	// Remove o pedido da tabela carrinho_temporario depois de ter adicionado na tabela de pedidos
	$delete = $pdo->prepare('DELETE FROM carrinho_temporario WHERE temporario_sessao = :sessao');
	$delete->bindValue(':sessao', $sessao);
	$delete->execute();

	if ($inserir && $delete) {
		echo 1;
	}else{
		echo 0;
	}

?>