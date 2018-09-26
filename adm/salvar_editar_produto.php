<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';



		$extensao = strtolower(substr($_FILES['prod_img']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';


		move_uploaded_file($_FILES['prod_img']['tmp_name'], $diretorio.$novo_nome);

		$data = date('Y-m-d H:i:s');


		$sql = $pdo->prepare('UPDATE produtos SET prod_nome = :prod_nome, prod_descricao = :prod_descricao, prod_preco = :prod_preco, prod_img = :prod_img, prod_tipo = :prod_tipo WHERE prod_ID = :prodID');

		$sql->bindValue(':prod_nome', $_POST['txtNomeProduto']);
		$sql->bindValue(':prod_descricao', $_POST['txtDescricaoProduto']);
		$sql->bindValue(':prod_preco', decimalBanco($_POST['txtPrecoProduto']));
		$sql->bindValue(':prod_tipo', $_POST['txt_tipo']);
		$sql->bindValue(':prod_img', $novo_nome);
		$sql->bindValue('prodID', $_POST['prodID']);
		$sql->execute();
		header('Location: index.php');

	// 	if (empty($_POST['img_prod-salvo'])) {
	
	// 	$extensao = strtolower(substr($_FILES['prod_img']['name'], -4));
	// 	$novo_nome = md5(time()) . $extensao;
	// 	$diretorio = '../img/produtos/uploads/';

	// 	move_uploaded_file($_FILES['prod_img']['tmp_name'], $diretorio.$novo_nome);

	// 	$data = date('Y-m-d H:i:s');

	// 	// Atualiza os dados no banco de dados
	// 	$sql = $pdo->prepare('UPDATE produtos SET prod_nome = :prod_nome, prod_descricao = :prod_descricao, prod_preco = :prod_preco, prod_img = :prod_img, prod_tipo = :prod_tipo WHERE prod_ID = :prodID');

	// 	$sql->bindValue(':prod_nome', $_POST['txtNomeProduto']);
	// 	$sql->bindValue(':prod_descricao', $_POST['txtDescricaoProduto']);
	// 	$sql->bindValue(':prod_preco', decimalBanco($_POST['txtPrecoProduto']));
	// 	$sql->bindValue(':prod_tipo', $_POST['txt_tipo']);
	// 	$sql->bindValue(':prod_img', $novo_nome);
	// 	$sql->bindValue('prodID', $_POST['prodID']);
	// 	$sql->execute();
	// 	header('Location: index.php');

	// }else{
	// 	$data = date('Y-m-d H:i:s');

	// 	// Atualiza os dados no banco de dados
	// 	$sql = $pdo->prepare('UPDATE produtos SET prod_nome = :prod_nome, prod_descricao = :prod_descricao, prod_preco = :prod_preco, prod_img = :prod_img, prod_tipo = :prod_tipo WHERE prod_ID = :prodID');

	// 	$sql->bindValue(':prod_nome', $_POST['txtNomeProduto']);
	// 	$sql->bindValue(':prod_descricao', $_POST['txtDescricaoProduto']);
	// 	$sql->bindValue(':prod_preco', decimalBanco($_POST['txtPrecoProduto']));
	// 	$sql->bindValue(':prod_tipo', $_POST['txt_tipo']);
	// 	$sql->bindValue(':prod_img', $_POST['img_prod-salvo']);
	// 	$sql->bindValue('prodID', $_POST['prodID']);
	// 	$sql->execute();
	// 	header('Location: index.php');
	// }




 ?>