<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';

	// if (isset($_FILES['img_pizza']['name'])) {

		$extensao = strtolower(substr($_FILES['img_promo']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';

		$data = date('Y-m-d H:i:s');

		// Atualiza os dados no banco de dados
		$sql = $pdo->prepare("UPDATE promocoes SET titulo = :titulo, desc_promo = :desc_promo, preco_promo = :preco_promo,duracao_promo = duracao, img_promo = :img, data = :data WHERE id = :id");

		$sql->bindValue(':titulo', $_POST['txtTitulo']);
		$sql->bindValue(':desc_promo', $_POST['txtDescricao']);
		$sql->bindValue(':preco_promo', decimalBanco($_POST['txtPreco']));
		$sql->bindValue(':img', $novo_nome);
		$sql->bindValue(':duracao', $_POST['txtDuracao']);
		$sql->bindValue(':id', $_POST['id']);
		$sql->bindValue('data', $data);
		$sql->execute();
		header('location:index.php');

	// }	
	
 ?>