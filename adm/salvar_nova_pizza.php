<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';

 	if (isset($_POST['img_pizza'])) {


		$sql = $pdo->prepare("INSERT INTO pizzas (sabor, precop, img_pizza, descricao, precom, precog, precogg) VALUES (:sabor, :precop, :img_pizza, :descricao, :precom, :precog, :precogg)");

		$sql->bindValue(':sabor', $_POST['txtSabor']);
		$sql->bindValue(':precop', decimalBanco($_POST['txtPrecop']));
		$sql->bindValue(':img_pizza', $_POST['img_pizza']);
		$sql->bindValue(':descricao', $_POST['txtDescricao']);
		$sql->bindValue(':precom', decimalBanco($_POST['txtPrecom']));
		$sql->bindValue(':precog', decimalBanco($_POST['txtPrecog']));
		$sql->bindValue(':precogg', decimalBanco($_POST['txtPrecogg']));
		$sql->execute();
		header('Location: index.php');

  	}


 ?>