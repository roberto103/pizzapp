<?php 

	session_start();
	require_once 'core/conexao.php';
  	require_once 'core/util.php';

	//Carrega todos os itens da tabela produtos
	$id = $_POST['id']; // Id pizza de 1 parte
	// $id_2 = $_POST['id']; // Id pizza de 2 partes
	$preco = $_POST['valor'];
	$sabor = $_POST['sabor']; // Sabor pizza de 1 parte
	// $sabor_2 = $_POST['sabor'].' / '.$_POST['sabor2']; // Sabores da pizza de 2 partes

	$data = date('Y-m-d H:i:s');
	$rand = rand(1000, 100000);
	
	//Verifica se a sessão pedido não existe, caso não exista ela será criada
	if (@!$_SESSION['pedido']) {
		$_SESSION['pedido'] = $rand;
		$sessao = $_SESSION['pedido'];
	}else{
		$sessao = $_SESSION['pedido'];
	}

	// Recupera a sessão com o ID do usuário
	$id_usuario = $_SESSION['id'];

  	//Verifica se o produto já existe no carrinho_temporario
	$consulta = $pdo->prepare('SELECT * FROM carrinho_temporario WHERE temporario_produto = :product AND temporario_sessao = :sessao');
	$consulta->bindValue(':product', $id);
  	$consulta->bindValue(':sessao', $sessao);
	$consulta->execute();

	$linhas = $consulta->rowCount();

	foreach ($consulta as $mostra) {
		$qtd = $mostra['temporario_quantidade'];
	}

	if ($linhas >= 1) {
		$valor = ($qtd+1);
		$altera = $pdo->prepare('UPDATE carrinho_temporario SET temporario_quantidade = :val WHERE temporario_sessao = :ses AND temporario_produto = :tp');
		$altera->bindValue(':val', $valor);
		$altera->bindValue(':ses', $sessao);
		$altera->bindValue(':tp', $id);
		
		if ($altera->execute()) {
			// Foi adicionado mais uma unidade desse produto!
			echo 2;
		}else{
			// O Produto não pôde ser adicionado ao carrinho.
			echo 0;
		}

	}else{
		$inserir = $pdo->prepare("INSERT INTO carrinho_temporario (ID_usuarios, temporario_produto, temporario_nome, temporario_quantidade, temporario_preco, temporario_img, temporario_data, temporario_sessao) VALUES (:ID_usuarios, :temporario_produto, :temporario_nome, :temporario_quantidade, :temporario_preco, :temporario_img, :temporario_data, :temporario_sessao)");
		$inserir->bindValue(':temporario_produto', $id);
		$inserir->bindValue(':ID_usuarios', $id_usuario);
		$inserir->bindValue(':temporario_nome', $sabor);
		$inserir->bindValue(':temporario_quantidade', $quantidade);
		$inserir->bindValue(':temporario_preco', decimalBanco($preco));
		$inserir->bindValue(':temporario_img', $img);
		$inserir->bindValue(':temporario_data', $data);
		$inserir->bindValue(':temporario_sessao', $sessao);
		

		if ($inserir->execute()) {
			// Produto foi adicionado ao carrinho.
			echo 1;
		}else{
			// O Produto não pôde ser adicionado ao carrinho.
			echo 0;
		}
  }

 ?>