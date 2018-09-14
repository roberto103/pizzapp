<?php
	
	session_start();
	include_once 'core/conexao.php';
	
	$sessao = $_POST['ref'];

	// $consulta = $pdo->prepare("SELECT * FROM carrinho_temporario WHERE temporario_sessao = :ses");
	// $consulta->bindValue(':ses', $sessao);

	$consulta = $pdo->prepare('SELECT c.*, u.* FROM carrinho_temporario c INNER JOIN usuarios u ON u.ID = c.ID_usuarios WHERE c.temporario_sessao = :ses');
	$consulta->bindValue(':ses', $sessao);

	$consulta->execute();
	$linhas = $consulta->rowCount();

	
	foreach ($consulta as $mostra) {

		$cliente_nome = $mostra['nome'].' '.$mostra['sobrenome'];
		$endereco = $mostra['endereco'];
		$ponto_referencia = $mostra['ponto_de_referencia'];

		$produto_id = $mostra['temporario_produto'];
		$produto_nome = $mostra['temporario_nome'];
		$produto_quantidade = $mostra['temporario_quantidade'];
		$produto_preco = $mostra['temporario_preco'];

		$valor_total = ($produto_quantidade * $produto_preco);
		$hora = date('H:i:s');

		@$descricao = $descricao . $produto_nome.' - '.$produto_quantidade.' Unidades </br>';

	}

	// Inseri o pedido na tabela de pedidos
	$inserir = $pdo->prepare("INSERT INTO pedidos (produto_id, cliente_nome, endereco, ponto_referencia, descricao, valor_total, hora, sessao, status) VALUES (:produto_id, :cliente_nome, :endereco, :ponto_referencia, :descricao, :valor_total, :hora, :sessao, :status)");

	$inserir->bindValue(':produto_id', $produto_id);
	$inserir->bindValue(':cliente_nome', $cliente_nome);
	$inserir->bindValue(':endereco', $endereco);
	$inserir->bindValue(':ponto_referencia', $ponto_referencia);
	$inserir->bindValue(':descricao', $descricao);
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