<?php 

	require_once 'core/conexao.php';

	if (isset($_FILES['img_pizza'])) {

		$extensao = strtolower(substr($_FILES['img_pizza']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';

		// Atualiza os dados no banco de dados
		$sql = $pdo->prepare("UPDATE pizzas SET sabor = :sabor, descricao = :descricao, preco = :preco, img_pizza = :img WHERE id = :id");

		$sql->bindValue(':sabor', $_POST['txtSaborPizza']);
		$sql->bindValue(':descricao', $_POST['txtDescricaoPizza']);
		$sql->bindValue(':preco', $_POST['txtPrecoPizza']);
		$sql->bindValue(':img', $novo_nome);
		$sql->bindValue(':id', $_POST['id']);
		$sql->execute();
		header('location:index.php');

	}	
	
 ?>