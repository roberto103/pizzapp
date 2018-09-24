<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';

 	if (isset($_FILES['img_pizza'])) {

		$extensao = strtolower(substr($_FILES['img_pizza']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';

		move_uploaded_file($_FILES['img_pizza']['tmp_name'], $diretorio.$novo_nome);


		$sql = $pdo->prepare("INSERT INTO pizzas (sabor, preco, img_pizza, descricao) VALUES (:sabor, :preco, :img_pizza, :descricao)");

		$sql->bindValue(':sabor', $_POST['txtSabor']);
		$sql->bindValue(':preco', decimalBanco($_POST['txtPreco']));
		$sql->bindValue(':img_pizza', $novo_nome);
		$sql->bindValue(':descricao', $_POST['txtDescricao']);
		$sql->execute();
		header('Location: index.php');

  	}


 ?>