<?php 

	require_once 'core/conexao.php';

 	if (isset($_POST['img_promo'])) {

		$data = date('Y-m-d H:i:s');

		$sql = $pdo->prepare('INSERT INTO promocoes (titulo, desc_promo, preco_promo, duracao_promo, img_promo, data) VALUES (:titulo, :desc_promo, :preco_promo, :duracao_promo, :img_promo, :data)');

		$sql->bindValue(':titulo', $_POST['txtTitulo']);
		$sql->bindValue(':desc_promo', $_POST['txtDesc']);
		$sql->bindValue(':preco_promo', $_POST['txtPreco']);
		$sql->bindValue(':duracao_promo', $_POST['txtDuracao']);
		$sql->bindValue(':img_promo', $_POST['img_promo']);
		$sql->bindValue(':data', $data);
		$sql->execute();
		header('Location: index.php');

  	}else{
  		echo "sdsdsd";
  	}


 ?>