<?php 

  require_once 'core/Sessao.php';
  if (!Sessao::estaLogado()) {
      header('Location: login.php');
    }

    $usr = $pdo->prepare('SELECT * FROM usuarios WHERE email = :email');
    $usr->bindValue(':email', $_SESSION['email']);
    $usr->execute();
    
    $usuarios = $usr->fetch(PDO::FETCH_OBJ);
    
 ?>
 <!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#bd2130">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.ico">
    <title>Dados para Entrega</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/form-validation.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
    <style type="text/css">
      h4{color: white;}label{color: white;}
    </style>
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
      </div> <!-- /navbar -->

      <div class="row" id="cart">
        <div class="col"></div>

        <div class="col-sm-6">
          <h4 class="mb-3">Endereço para entrega</h4>
          <form method="POST" action="core/att.php" class="needs-validation" novalidate>
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="primeiroNome">Nome</label>
                <input type="text" class="form-control" name="nome" id="primeiroNome" placeholder="" value="<?php echo $usuarios->nome; ?>" required>
                <div class="invalid-feedback">
                  É obrigatório inserir um nome válido.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" class="form-control" name="sobrenome" id="sobrenome" placeholder="" value="<?php echo $usuarios->sobrenome; ?>" required>
                <div class="invalid-feedback">
                  É obrigatório inserir um sobre nome válido.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="email">Email</label>
              <input value="<?php echo $usuarios->email; ?>" type="email" class="form-control" name="email" id="email" placeholder="fulano@exemplo.com" required>
              <div class="invalid-feedback">
                Por favor, insira um endereço de e-mail válido, para atualizações de entrega.
              </div>
            </div>

            <div class="mb-3">
              <label for="endereco">Endereço</label>
              <input value="<?php echo $usuarios->endereco; ?>" type="text" class="form-control" name="endereco" id="endereco" placeholder="Rua da academia, nº 45" required>
              <div class="invalid-feedback">
                Por favor, insira seu endereço de entrega.
              </div>
            </div>

            <div class="mb-3">
              <label for="endereco2">Ponto de referência</label>
              <input type="text" class="form-control" name="ponto_de_referencia" id="endereco2" placeholder="Ex: Em frente a padaria." value="<?php echo $usuarios->ponto_de_referencia; ?>" required>
              <div class="invalid-feedback">
                Por favor, insira um ponto de referência.
              </div>
            </div>

            <hr class="mb-2">
            <button class="btn btn-primary btn-lg btn-block" type="submit" style="border-radius: 0;"><i class="fas fa-check-circle"></i> Salvar</button>
            <hr class="mb-2">
          </form>
        </div>

        <div class="col"></div>
      </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="https://getbootstrap.com/docs/4.1/assets/js/vendor/holder.min.js"></script>

    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
      (function() {
        'use strict';

        window.addEventListener('load', function() {
          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.getElementsByClassName('needs-validation');

          // Loop over them and prevent submission
          var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
              if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
              }
              form.classList.add('was-validated');
            }, false);
          });
        }, false);
      })();
    </script>
  </body>
</html>
