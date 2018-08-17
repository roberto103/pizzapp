<?php 

    require_once 'core/Sessao.php';
    require_once 'core/conexao.php';
    require_once 'core/util.php';

    if (!Sessao::estaLogado()) {
    header('Location: login.php');
    }

    $sql = $pdo->prepare('SELECT * FROM promocoes ORDER BY data DESC');
    $sql->execute();

    $promo = $sql->fetchAll(PDO::FETCH_OBJ);

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/toast.css">

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
        <div class="col-md-6" id="cart">

          <!-- PROMOÇÕES -->
          <?php foreach ($promo as $promocao) {   ?>

          <div class="card mb-3" style="border: 0;">
            <a class="comprarCombo" data-id_promocao="<?php echo $promocao->id; ?>" href>
              <img class="card-img-top" src="img/produtos/uploads/<?php echo $promocao->img_promo; ?>" title="<?php echo $promocao->titulo; ?>" alt="<?php echo $promocao->titulo; ?>">
            </a>
            <div class="card-body">
              <h5 class="card-title" style="text-transform: capitalize;"><?php echo $promocao->titulo; ?></h5>
              <p class="card-text"><?php echo $promocao->desc_promo; ?>
              <strong class="d-block">R$ <?php echo decimalTela($promocao->preco_promo); ?></strong>
              </p>
            </div>
            <div class="card-footer text-center">
              <small>Válido por <?php echo $promocao->duracao_promo; ?> dias</small>
            </div>
          </div>

          <?php } ?>
          <!-- /PROMOÇÕES -->

        </div>
        <div class="col"></div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){

        $('.comprarCombo').click(function(){

            var id_promocao = $(this).attr('data-id_promocao');
            
            $.ajax({
              url : "comprarPromocao.php",
              type : 'post',
              data : {
                   combo : id_promocao
              },
              success : function(data){
                 if (data == 1) {
                    M.toast({html: 'O Produto foi adicionado ao carrinho.'});
                 } else if(data == 2){
                    M.toast({html: 'Foi adicionado mais uma unidade desse produto!'});
                 } else {
                    M.toast({html: 'O Produto não pôde ser adicionado ao carrinho.'});
                 } 
              }//success
            });//ajax
            return false;
        });//#comprarProduto

      });//documento.ready
    </script>

  </body>
</html>