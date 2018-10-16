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
		<link rel="stylesheet" type="text/css" href="css/signin.css">

		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

	</head>
	<body>

		<?php include_once 'sidebar_includes/menu.php'; ?>

		<div class="container-fluid">
			<div class="row">
				<div class="col"></div>
				<div class="col-sm-4" id="info">

					<img src="img/logo.png" class="rounded-circle mx-auto d-block mb-3" width="40%">

					<form class="form-signin">
						<label for="email" class="sr-only">Email</label>
						<input type="email" id="email" class="form-control" placeholder="Digite seu email." required autofocus>

						<label for="senha" class="sr-only">Senha</label>
						<input type="password" id="senha" class="form-control" placeholder="Digite sua senha." required>

						<div style="display: none;" class="alert alert-danger" role="alert">
							Email ou senha incorretos!
						</div>

						<button class="btn btn-lg btn-primary btn-block mb-4" id="btLogin" type="submit">Logar</button>

						<center>
							<a href="cadastro.php" class="text-white text-center">Cadastre-se agora</a>
						</center>
					</form>

				</div>
				<div class="col"></div>
			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->
		
		<script type="text/javascript">
			
			$(document).ready(function(){
			 
				
				$('#btLogin').click(function(){

						var usuario = $("#email").val();
						var senha = $("#senha").val();
						
						$.ajax({
							url : "auth/validar.php",
							type : 'post',
							data : {
									 email : usuario,
									 senha :senha
							},
							success : function(data){
								 if (data == 1) {
										window.location = 'cardapio.php';
								 }else if(data == 2){
										alert('Os campos não podem estar vazios');
								 } else {
										$('.alert-danger').css('display', 'block');
								 } 
							}//success          
						});//ajax

						return false;

				});//#btLogin



			});//documento.ready

		</script>
	</body>
</html>