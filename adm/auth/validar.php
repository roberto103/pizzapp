<?php 

require_once '../core/Sessao.php';

if (Sessao::login($_POST['email'],$_POST['senha']))
{
	echo 1;
} else {
	echo 0;
}

	/*require_once '../core/conexao.php';

	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$buscarUsuario = $pdo->prepare("SELECT * FROM adm WHERE email = :email AND senha = :senha");
	$buscarUsuario->bindValue(":email", $email);
	$buscarUsuario->bindValue(":senha", $senha);
	$buscarUsuario->execute();

	while ($dado = $buscarUsuario->fetch()) {
		session_start();
		$_SESSION['nome'] = $dado['nome'];
		$_SESSION['id'] = $dado['id'];
	}

	$rows = $buscarUsuario->rowCount();
	if ($rows == 1) {
		$_SESSION['email'] = $email;
		$_SESSION['senha'] = $senha;
		echo 1;
	}else{
		echo 0;
	}*/

 ?>