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
    </script>
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
      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col-sm-6" id="cads">
          <form class="needs-validation" method="POST">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="txtNome">Nome</label>
                <input name="nome" type="text" class="form-control" id="txtNome" placeholder="" value="" style="border-radius: 0;" required>
                <div class="invalid-feedback">
                  É obrigatório inserir um nome válido.
                </div>
              </div>
              <div class="col-md-6 mb-3">
                <label for="txtSobrenome">Sobrenome</label>
                <input name="sobrenome" type="text" class="form-control" id="txtSobrenome" placeholder="" value="" style="border-radius: 0;" required>
                <div class="invalid-feedback">
                  É obrigatório inserir um sobre nome válido.
                </div>
              </div>
            </div>

            <div class="mb-3">
              <label for="txtEmail">Email</label>
              <input name="email" type="email" class="form-control" id="txtEmail" placeholder="fulano@exemplo.com" style="border-radius: 0;" required>
              <div class="invalid-feedback">
                Por favor, insira um endereço de e-mail válido, para atualizações de entrega.
              </div>
            </div>

            <div class="mb-3">
              <label for="txtEndereco">Endereço</label>
              <input name="endereco" type="text" class="form-control" id="txtEndereco" placeholder="Rua da academia, nº 45" style="border-radius: 0;" required>
              <div class="invalid-feedback">
                Por favor, insira seu endereço de entrega.
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="txtSenha">Senha</label>
                <input name="senha" type="password" class="form-control" id="txtSenha" style="border-radius: 0;" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="txtConfirmar_senha">Confirmar senha</label>
                <input name="confirmar_senha" type="password" class="form-control" id="txtConfirmar_senha" style="border-radius: 0;" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="txtPonto_de_referencia">Ponto de referência</label>
              <input name="ponto_de_referencia" type="text" class="form-control" id="txtPonto_de_referencia" placeholder="Ex: Em frente a padaria." style="border-radius: 0;" required>
              <div class="invalid-feedback">
                Por favor, insira um ponto de referência.
              </div>
            </div>

            <hr class="mb-2">
            <button class="btn btn-primary btn-lg btn-block disabled" type="submit" style="border-radius: 0;" id="btSalvar">
              <i class="fas fa-check-circle"></i> Salvar
            </button>
            <hr class="mb-2">
          </form>
        </div>
        <div class="col"></div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
          $('#txtConfirmar_senha').focusout(function(){
              if ($('#txtSenha').val() == $('#txtConfirmar_senha').val()) {
                $('#btSalvar').removeClass('disabled');
              } else {
                $('#btSalvar').addClass('disabled');
              }
          });

          // Cadastro
          $('#btSalvar').click(function(){

            var txtNome = $("#txtNome").val();
            var txtSobrenome = $("#txtSobrenome").val();
            var txtEmail = $("#txtEmail").val();
            var txtEndereco = $("#txtEndereco").val();
            var txtPonto_de_referencia = $("#txtPonto_de_referencia").val();
            var txtSenha = $("#txtSenha").val();
            var txtConfirmar_senha = $("#txtConfirmar_senha").val();
            
            $.ajax({
              url: "core/cad.php",
              type: 'post',
              data: {
                   nome: txtNome,
                   sobrenome: txtSobrenome,
                   email: txtEmail,
                   endereco: txtEndereco,
                   ponto_de_referencia: txtPonto_de_referencia,
                   senha: txtSenha,
                   confirmar_senha: txtConfirmar_senha
              },
              success: function(data){
                 if (data == 1) {
                    alert('Cadastrado com sucesso!');
                    window.location = 'login.php';
                 }else if (data == 2) {
                    alert('Esse email já está sendo usado!');
                 }else{
                    alert('Senhas não conferem!');
                 }
              }//success
            });//ajax
            return false;
        });//#btSalvar

      });
    </script>
    
  </body>
</html>