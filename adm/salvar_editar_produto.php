<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';

	if (empty($_POST['img'])) {

		$sql = $pdo->prepare('UPDATE produtos SET prod_nome = :prod_nome, prod_descricao = :prod_descricao, prod_preco = :prod_preco, prod_img = :prod_img, prod_tipo = :prod_tipo WHERE prod_ID = :prodID');

		$sql->bindValue(':prod_nome', $_POST['txtNomeProduto']);
		$sql->bindValue(':prod_descricao', $_POST['txtDescricaoProduto']);
		$sql->bindValue(':prod_preco', decimalBanco($_POST['txtPrecoProduto']));
		$sql->bindValue(':prod_tipo', $_POST['txt_tipo']);
		$sql->bindValue(':prod_img', $novo_nome);
		$sql->bindValue('prodID', $_POST['prodID']);
		$sql->execute();
		header('Location: index.php');

	}else{

		$sql = $pdo->prepare('UPDATE produtos SET prod_nome = :prod_nome, prod_descricao = :prod_descricao, prod_preco = :prod_preco, prod_img = :prod_img, prod_tipo = :prod_tipo WHERE prod_ID = :prod_ID');

		$sql->bindValue(':prod_nome', $_POST['txtNomeProduto']);
		$sql->bindValue(':prod_descricao', $_POST['txtDescricaoProduto']);
		$sql->bindValue(':prod_preco', decimalBanco($_POST['txtPrecoProduto']));
		$sql->bindValue(':prod_tipo', $_POST['txt_tipo']);
		$sql->bindValue(':prod_img', $_POST['img']);
		$sql->bindValue(':prod_ID', $_POST['prodID']);
		$sql->execute();
		header('Location: index.php');
	}

?>