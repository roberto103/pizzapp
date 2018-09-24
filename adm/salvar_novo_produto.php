<?php

	require_once 'core/conexao.php';
	require_once 'core/util.php';

 	if (isset($_FILES['img'])) {

		$extensao = strtolower(substr($_FILES['img']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';

		move_uploaded_file($_FILES['img']['tmp_name'], $diretorio.$novo_nome);


		$sql = $pdo->prepare("INSERT INTO produtos (prod_nome, prod_descricao, prod_preco, prod_img, prod_tipo) VALUES (:prod_nome, :prod_descricao, :prod_preco, :prod_img, :prod_tipo)");

		$sql->bindValue(':prod_nome', $_POST['txtNome']);
		$sql->bindValue(':prod_descricao', $_POST['txtDescricao']);
		$sql->bindValue(':prod_preco', decimalBanco($_POST['txtPreco']));
		$sql->bindValue(':prod_img', $novo_nome);
		$sql->bindValue(':prod_tipo', $_POST['tipo_prod']);
		$sql->execute();
		header('Location: index.php');

  	}



 ?>