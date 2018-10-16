<?php 
		
		require_once 'core/Sessao.php';

		if (!Sessao::estaLogado()) {
				header('Location: login.php');
		}
		
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#bd2130">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<title>Pizzapp</title>
		<link rel="shortcut icon" href="img/favicon.ico" />
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
		</script>
		<style type="text/css">
			h4{color: white;}label{color: white;}
		</style>

		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

	</head>
	<body>

		<?php include_once 'sidebar_includes/menu.php'; ?>

		<div class="container-fluid">
			<div class="row">
				<div class="col"></div>
				<div class="col-sm-6" id="cads">
				<h4 style="color: #fff; text-align: center;">Envie sua crítica, sugestão ou elogio.</h4>
					<form action="core/comentarios.php" method="POST">
						<div class="form-group">
							<label for="nome">Nome</label>
							<input type="txt" class="form-control" name="nome" id="nome" placeholder="Seu nome" style="border-radius: 0;" required>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" id="email" placeholder="Seu email" style="border-radius: 0;" value="<?php echo $_SESSION['email']; ?>" disabled required>
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">Sua mensagem:</label>
							<textarea class="form-control" name="comentario" id="message-text" style="height: 100px; border-radius: 0;" minlength="15" required></textarea>
						</div>
						<button type="submit" class="btn btn-primary" id="btEnviar" style="width: 100%; border-radius: 0;">ENVIAR</button>
					</form>
				</div>
				<div class="col"></div>
			</div>
		</div>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

	</body>
</html>