<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#bd2130">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Pizzapp</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/signin.css">

  </head>

  <body class="text-center">

    <form class="form-signin">
      <img class="mb-4 rounded-circle" src="../img/logo.png" alt="Logo" width="120" height="120">

      <h1 class="h3 mb-3 font-weight-normal">Logue-se, por favor.</h1>
      <label for="email" class="sr-only">Email</label>
      <input type="email" id="email" class="form-control" placeholder="Digite seu email." required autofocus>

      <label for="senha" class="sr-only">Senha</label>
      <input type="password" id="senha" class="form-control" placeholder="Digite sua senha." required>

      <div style="display: none;" class="alert alert-danger" role="alert">
        Email ou senha incorretos!
      </div>

      <button class="btn btn-lg btn-primary btn-block" id="btLogin" type="submit">Logar</button>

      <p class="mt-5 mb-3 text-muted">&copy; Copyright 2018 por Império Sistemas. All Rights Reserved.</p>

    </form>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

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
                    window.location = 'index.php';
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
