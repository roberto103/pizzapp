<?php 

/*require_once '../core/Sessao.php';

if (Sessao::login($_POST['email'],$_POST['senha']))
{
	echo 1;
} else {
	echo 0;
}*/
	
	require_once '../core/util.php';
	require_once '../core/conexao.php';

	$email = $_POST['email'];
	$senha = geraHash($_POST['senha'], SALT);

	$buscarUsuario = $pdo->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
	$buscarUsuario->bindValue(":email", $email);
	$buscarUsuario->bindValue(":senha", $senha);
	$buscarUsuario->execute();

	while ($dado = $buscarUsuario->fetch()) {
		session_start();
		$_SESSION['nome'] = $dado['nome'];
		$_SESSION['id'] = $dado['ID'];
	}

	$rows = $buscarUsuario->rowCount();
	if ($rows == 1) {
		$_SESSION['email'] = $email;
		$_SESSION['senha'] = $senha;
		echo 1;
	}else{
		echo 0;
	}

 ?>