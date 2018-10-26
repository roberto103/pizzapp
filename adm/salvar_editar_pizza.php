<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';

	if (empty($_POST['img'])) {

		$sql = $pdo->prepare("UPDATE pizzas SET sabor = :sabor, descricao = :descricao, precop = :precop, precom = :precom, precog = :precog, precogg = :precogg, img_pizza = :img WHERE id = :id");

		$sql->bindValue(':sabor', $_POST['txtSaborPizza']);
		$sql->bindValue(':descricao', $_POST['txtDescricaoPizza']);
		$sql->bindValue(':precop', decimalBanco($_POST['txtPrecoPizzap']));
		$sql->bindValue(':precom', decimalBanco($_POST['txtPrecoPizzam']));
		$sql->bindValue(':precog', decimalBanco($_POST['txtPrecoPizzag']));
		$sql->bindValue(':precogg', decimalBanco($_POST['txtPrecoPizzagg']));
		$sql->bindValue(':img', $_POST['imgvazia']);
		$sql->bindValue(':id', $_POST['id']);
		$sql->execute();
		header('location:index.php');

	}else{
		$data = date('Y-m-d H:i:s');

		// Atualiza os dados no banco de dados
		$sql = $pdo->prepare("UPDATE pizzas SET sabor = :sabor, descricao = :descricao, precop = :precop, precom = :precom, precog = :precog, precogg = :precogg, img_pizza = :img WHERE id = :id");

		$sql->bindValue(':sabor', $_POST['txtSaborPizza']);
		$sql->bindValue(':descricao', $_POST['txtDescricaoPizza']);
		$sql->bindValue(':precop', decimalBanco($_POST['txtPrecoPizzap']));
		$sql->bindValue(':precom', decimalBanco($_POST['txtPrecoPizzam']));
		$sql->bindValue(':precog', decimalBanco($_POST['txtPrecoPizzag']));
		$sql->bindValue(':precogg', decimalBanco($_POST['txtPrecoPizzagg']));
		$sql->bindValue(':img', $_POST['img']);
		$sql->bindValue(':id', $_POST['id']);
		$sql->execute();
		header('location:index.php');
	}	
	
 ?>