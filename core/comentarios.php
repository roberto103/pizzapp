<?php
	
	require_once 'conexao.php';

	$data = date('Y-m-d');

	if(isset($_POST['nome'])){

	    $sql = $pdo->prepare('INSERT INTO comentarios (nome, email, data, comentario) VALUES (:nome, :email, :data, :comentario)');

	    $sql->bindValue(':nome', $_POST['nome']);
	    $sql->bindValue(':email', $_POST['email']);
	    $sql->bindValue(':data', $data);
	    $sql->bindValue(':comentario', $_POST['comentario']);
	    $sql->execute();
	    
	    header('Location: ../success.php');
	}

?>