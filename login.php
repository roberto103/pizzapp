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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">

  </head>
  <body>
    <div class="container-fluid">
      <div class="row" >
        <nav class="navbar navbar-expand-lg navbar-light bg-light" style=" width: 100%; position: absolute; z-index: 9999; background-color: #bd2130 !important;">
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                  <a class="nav-item nav-link" href="index.php" style="color: white;"><i class="fas fa-home"></i> Home</a>
                  <a class="nav-item nav-link" href="cardapio.php" style="color: white;"><i class="fas fa-book-open"></i> Cardápio</a>
                  <a class="nav-item nav-link" href="promocoes.php" style="color: white;"><i class="fas fa-dollar-sign"></i> Promoções</a>
                  <a class="nav-item nav-link" href="cart.php" style="color: white;"><i class="fas fa-shopping-cart"></i> Meu Pedido</a>
                  <a class="nav-item nav-link" href="entrega.php" style="color: white;"><i class="fas fa-map-marker-alt"></i> Local de Entrega</a>
                  <a class="nav-item nav-link" href="conta.php" style="color: white;"><i class="fas fa-user-alt"></i> Minha conta</a>
                  <a class="nav-item nav-link" href="critica.php" style="color: white;"><i class="fas fa-comment-alt"></i> Criticas e sugestões</a>
                  <a class="nav-item nav-link" href="tel:08136341122" style="color: white;"><i class="fas fa-phone"></i> Pedir por telefone</a>
                </div>
             </div>
        </nav> 
      </div>
      <div class="row">
        <div class="col"></div>
        <div class="col-sm-4" id="info">
          
        	<form action="" method="post">
    			  <div class="form-group">
    			    <label for="exampleInputEmail1" style="color: white;">Email</label>
    			    <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Digite seu email." style="border-radius: 0px;">
    			  </div>
    			  <div class="form-group">
    			    <label for="exampleInputPassword1" style="color: white;">Senha</label>
    			    <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite sua senha." style="border-radius: 0px;">
    			  </div>
    			  <div class="custom-control custom-checkbox">
      				<input type="checkbox" class="custom-control-input" id="customCheck1">
     			 	  <label class="custom-control-label" for="customCheck1" style="color: white;">Mantenha-me conectado</label>
    			  </div>
    			  <hr class="mb-3">
    			  <button id="btLogin" type="submit" class="btn btn-primary" style="width: 100%; border-radius: 0;"><i class="fas fa-check-circle"></i> Login</button>
            <br> <br>
            <a href="cadastro.php" class="btn btn-primary" style="width: 100%; border-radius: 0;">Cadastrar</a>
    			  <hr class="mb-3">
    			</form>

        </div>
        <div class="col"></div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
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
                 } else {
                    alert('Senha ou email incorretos!');
                 } 
              }//success          
            });//ajax

            return false;

        });//#btLogin



      });//documento.ready

    </script>
  </body>
</html>