<?php 

  require_once 'core/Sessao.php';
  require_once 'core/conexao.php';

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
    <title>Minha Conta</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">


  </head>
  <body>

    <?php include_once 'sidebar_includes/menu.php'; ?>

    <div class="container-fluid">
      <div class="row">
         <div class="col-sm-12" style="height: 100px; background-color: #343a40; color: white;">
          <div style="float: left;">
            <span>
              <i class="fas fa-user-alt" style="margin-top: 70px;"></i>
            </span>
          </div>
          <h6 style="margin-top: 68px; display: inline-block; margin-left: 15px;">Olá,
            <?php 

            if (!isset($_SESSION['nome_adm'])) {
              echo $_SESSION['nome'];
            }else{
              echo $_SESSION['nome_adm'];
            }

            ?>!</h6>
          <div style="display: inline-block; float: right;">
            <a href="core/doLogout.php">
              <i class="fas fa-sign-out-alt" style="margin-top: 70px;"></i>
            </a>
          </div>
        </div>

      </div>
      <div class="row">
        <div class="col-sm-12" style="height: 60px; color: white; margin-top: 15px; border-bottom: solid 1px;">
            <a href="historico.php" style="color: white;">
              <h5>
              <i class="fas fa-shopping-cart"></i> Meus pedidos
            </h5>
          </a>
        </div>
        <hr class="mb-6">
        <div class="col-sm-12" style="height: 60px; color: white; margin-top: 15px; border-bottom: solid 1px;">
            <a href="entrega.php" style="color: white;">
              <h5>
              <i class="fas fa-home"></i> Endereço
            </h5>
          </a>
        </div>
        <hr class="mb-6">
        <div class="col-sm-12" style="height: 60px; color: white; margin-top: 15px; border-bottom: solid 1px;">
            <a href="atualizarSenha.php" style="color: white;">
              <h5>
              <i class="fas fa-unlock-alt"></i> Alterar senha
            </h5>
          </a>
        </div>
        <hr class="mb-6">
        <div class="col-sm-2">
          
        </div>
        <div class="col-sm-8" style="margin-top: 40px;">
          <a href="critica.php">
            <button class="btn btn-primary btn-lg btn-block" type="submit" style="border-radius: 0;">
               Fale conosco
            </button>
          </a>
        </div>
      </div>
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>