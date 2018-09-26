<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';

	// if (isset($_FILES['img_pizza']['name'])) {

	// 	$extensao = strtolower(substr($_FILES['img_pizza']['name'], -4));
	// 	$novo_nome = md5(time()) . $extensao;
	// 	$diretorio = '../img/produtos/uploads/';

	// 	move_uploaded_file($_FILES['img_pizza']['tmp_name'], $diretorio.$novo_nome);

	// 	// Atualiza os dados no banco de dados
		// $sql = $pdo->prepare("UPDATE pizzas SET sabor = :sabor, descricao = :descricao, precop = :precop, precom = :precom, precog = :precog, precogg = :precogg, img_pizza = :img WHERE id = :id");

		// $sql->bindValue(':sabor', $_POST['txtSaborPizza']);
		// $sql->bindValue(':descricao', $_POST['txtDescricaoPizza']);
		// $sql->bindValue(':precop', decimalBanco($_POST['txtPrecoPizzap']));
		// $sql->bindValue(':precom', decimalBanco($_POST['txtPrecoPizzam']));
		// $sql->bindValue(':precog', decimalBanco($_POST['txtPrecoPizzag']));
		// $sql->bindValue(':precogg', decimalBanco($_POST['txtPrecoPizzagg']));
		// $sql->bindValue(':img', $novo_nome);
		// $sql->bindValue(':id', $_POST['id']);
		// $sql->execute();
		// header('location:index.php');

	// }

	if (empty($_POST['img_pizza-salva'])) {
	
		$extensao = strtolower(substr($_FILES['img_pizza']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';

		move_uploaded_file($_FILES['img_pizza']['tmp_name'], $diretorio.$novo_nome);

		$data = date('Y-m-d H:i:s');

		// Atualiza os dados no banco de dados
		$sql = $pdo->prepare("UPDATE pizzas SET sabor = :sabor, descricao = :descricao, precop = :precop, precom = :precom, precog = :precog, precogg = :precogg, img_pizza = :img WHERE id = :id");

		$sql->bindValue(':sabor', $_POST['txtSaborPizza']);
		$sql->bindValue(':descricao', $_POST['txtDescricaoPizza']);
		$sql->bindValue(':precop', decimalBanco($_POST['txtPrecoPizzap']));
		$sql->bindValue(':precom', decimalBanco($_POST['txtPrecoPizzam']));
		$sql->bindValue(':precog', decimalBanco($_POST['txtPrecoPizzag']));
		$sql->bindValue(':precogg', decimalBanco($_POST['txtPrecoPizzagg']));
		$sql->bindValue(':img', $novo_nome);
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
		$sql->bindValue(':img', $_POST['img_pizza-salva']);
		$sql->bindValue(':id', $_POST['id']);
		$sql->execute();
		header('location:index.php');
	}	
	
 ?>