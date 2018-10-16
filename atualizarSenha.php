<?php 

  require_once 'core/Sessao.php';
  if (!Sessao::estaLogado()) {
      header('Location: login.php');
    }
 
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
    <style type="text/css">
      h4{color: white;}label{color: white;}
    </style>
    <!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

  </head>

  <body>
    <div class="container-fluid">
      <div class="row">
        <?php include_once 'sidebar_includes/menu.php'; ?>
      </div>

      <div class="row" id="cart">
        <div class="col"></div>

        <div class="col-sm-6">
          <h4 class="mb-3">Mudar senha</h4>
          <form method="POST" action="core/attSenha.php" class="needs-validation" novalidate>
            <div class="mb-3">
              <label for="senha">Senha</label>
              <input type="password" class="form-control" name="senha" id="senha" required>
              <div class="invalid-feedback">
                Por favor, insira uma senha.
              </div>
            </div>

            <div class="mb-3">
              <label for="confirmar_senha">Confirmar senha</label>
              <input type="password" class="form-control" name="confirmar_senha" id="confirmar_senha" required>
              <div class="invalid-feedback">
                Por favor, confirme sua senha.
              </div>
            </div>

            <hr class="mb-2">
            <button class="btn btn-primary btn-lg btn-block" type="submit" style="border-radius: 0;"><i class="fas fa-check-circle"></i> Salvar</button>
            <hr class="mb-2">
          </form>
        </div>

        <div class="col"></div>
      </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

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
