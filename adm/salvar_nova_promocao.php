<?php 

	require_once 'core/conexao.php';

 	if (isset($_FILES['img_promo'])) {

		$extensao = strtolower(substr($_FILES['img_promo']['name'], -4));
		$novo_nome = md5(time()) . $extensao;
		$diretorio = '../img/produtos/uploads/';

		$data = date('Y-m-d H:i:s');

		move_uploaded_file($_FILES['img_promo']['tmp_name'], $diretorio.$novo_nome);


		$sql = $pdo->prepare('INSERT INTO promocoes (titulo, desc_promo, preco_promo, duracao_promo, img_promo, data) VALUES (:titulo, :desc_promo, :preco_promo, :duracao_promo, :img_promo, :data)');

		$sql->bindValue(':titulo', $_POST['txtTitulo']);
		$sql->bindValue(':desc_promo', $_POST['txtDesc']);
		$sql->bindValue(':preco_promo', $_POST['txtPreco']);
		$sql->bindValue(':duracao_promo', $_POST['txtDuracao']);
		$sql->bindValue(':img_promo', $novo_nome);
		$sql->bindValue(':data', $data);
		$sql->execute();
		header('Location: index.php');

  	}else{
  		echo "sdsdsd";
  	}


 ?>