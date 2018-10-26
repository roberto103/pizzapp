<?php 

	require_once 'core/conexao.php';
	require_once 'core/util.php';

	if (empty($_POST['img'])) {
	
		$data = date('Y-m-d H:i:s');

		$sql = $pdo->prepare('UPDATE promocoes SET titulo = :titulo, desc_promo = :desc_promo, preco_promo = :preco_promo, duracao_promo = :duracao, img_promo = :img, data = :data WHERE id = :id');

		$sql->bindValue(':titulo', $_POST['txtTitulo']);
		$sql->bindValue(':desc_promo', $_POST['txtDescricao']);
		$sql->bindValue(':preco_promo', decimalBanco($_POST['txtPreco']));
		$sql->bindValue(':img', $_POST['imgvazia']);
		$sql->bindValue(':duracao', $_POST['txtDuracao']);
		$sql->bindValue(':data', $data);
		$sql->bindValue(':id', $_POST['id']);
		$sql->execute();
		header('location:index.php');

	}else{
		$data = date('Y-m-d H:i:s');

		$sql = $pdo->prepare('UPDATE promocoes SET titulo = :titulo, desc_promo = :desc_promo, preco_promo = :preco_promo, duracao_promo = :duracao, img_promo = :img, data = :data WHERE id = :id');

		$sql->bindValue(':titulo', $_POST['txtTitulo']);
		$sql->bindValue(':desc_promo', $_POST['txtDescricao']);
		$sql->bindValue(':preco_promo', decimalBanco($_POST['txtPreco']));
		$sql->bindValue(':img', $_POST['img']);
		$sql->bindValue(':duracao', $_POST['txtDuracao']);
		$sql->bindValue(':data', $data);
		$sql->bindValue(':id', $_POST['id']);
		$sql->execute();
		header('location:index.php');
	}
	
 ?>