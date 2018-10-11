<?php

	require_once 'core/conexao.php';
	require_once 'core/util.php';

 	if (isset($_POST['img'])) {


		$sql = $pdo->prepare("INSERT INTO produtos (prod_nome, prod_descricao, prod_preco, prod_img, prod_tipo) VALUES (:prod_nome, :prod_descricao, :prod_preco, :prod_img, :prod_tipo)");

		$sql->bindValue(':prod_nome', $_POST['txtNome']);
		$sql->bindValue(':prod_descricao', $_POST['txtDescricao']);
		$sql->bindValue(':prod_preco', decimalBanco($_POST['txtPreco']));
		$sql->bindValue(':prod_img', $_POST['img']);
		$sql->bindValue(':prod_tipo', $_POST['tipo_prod']);
		$sql->execute();
		header('Location: index.php');

  	}else{
  		echo 0;
  	}



 ?>