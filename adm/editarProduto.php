<?php 

	require_once 'core/conexao.php';

	$extensao = strtolower(substr($_POST['prod_img'], -4));
	$novo_nome = md5(time()) . $extensao;
	$diretorio = '../img/produtos/uploads/';

	$data = date('Y-m-d H:i:s');

	//move_uploaded_file($_FILES['upload']['tmp_name'], $diretorio.$novo_nome);

	// Atualiza os dados no banco de dados
	$sql = $pdo->prepare("UPDATE produtos SET prod_nome = :nome, prod_descricao = :descricao, prod_preco = :preco, prod_tipo = :tipo, prod_img = :img WHERE prod_ID = :id");

	$sql->bindValue(':nome', $_POST['prod_nome']);
	$sql->bindValue(':descricao', $_POST['prod_descricao']);
	$sql->bindValue(':preco', $_POST['prod_preco']);
	$sql->bindValue(':tipo', $_POST['prod_tipo']);
	$sql->bindValue(':img', $novo_nome);
	$sql->bindValue(':id', $_POST['prod']);
	$sql->execute();

	if ($sql->execute()) {
		echo 1;
	}else{
		echo 0;
	}
	
 ?>