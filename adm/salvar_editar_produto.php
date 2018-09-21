<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';



		$extensao = strtolower(substr($_FILES['prod_img']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';

		$data = date('Y-m-d H:i:s');

		move_uploaded_file($_FILES['prod_img']['tmp_name'], $diretorio.$novo_nome);


		$sql = $pdo->prepare('INSERT INTO produtos (prod_nome, prod_descricao, prod_preco, prod_img, prod_tipo) VALUES (:prod_nome, :prod_descricao, :prod_preco, :prod_img, :prod_tipo)');

		$sql->bindValue(':prod_nome', $_POST['txtNomeProduto']);
		$sql->bindValue(':prod_descricao', $_POST['txtDescricaoProduto']);
		$sql->bindValue(':prod_preco', $_POST['txtPrecoProduto']);
		$sql->bindValue(':prod_tipo', $_POST['txt_tipo']);
		$sql->bindValue(':prod_img', $novo_nome);
		$sql->execute();
		header('Location: index.php');




 ?>