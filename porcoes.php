<?php 

  require_once 'core/Sessao.php';
  require_once 'core/conexao.php';
  require_once 'core/util.php';

  if (!Sessao::estaLogado()) {
      header('Location: login.php');
    }

    $tipo = 'Porcoes';
    $sql = $pdo->prepare('SELECT * FROM produtos WHERE prod_tipo = :tipo ORDER BY prod_ID ASC');
    $sql->bindValue(':tipo', $tipo);
    $sql->execute();

    $porcao = $sql->fetchAll(PDO::FETCH_OBJ);

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

    <link rel="stylesheet" type="text/css" href="css/toast.css">

    <!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

  </head>
  <body>

    <?php include_once 'sidebar_includes/menu.php'; ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col"></div>
        <div class="col-sm-4" id="cart">

          <!-- PORÇÕES -->
          <?php 
            foreach ($porcao as $porcoes) { ?>
            <div id="lista_bebidas">

              <div id="infoBebidas">
                <img src="img/produtos/produtos/<?php echo $porcoes->prod_img; ?>" id="img-prod">
                <h4><?php echo $porcoes->prod_nome; ?></h4>
                <p><?php echo $porcoes->prod_descricao; ?></p>
                <hr class="mb-3">

                <div id="precoBebidas">
                  <span>R$ <?php echo decimalTela($porcoes->prod_preco); ?></span>
                  <a class="comprarProduto" data-id_porcao="<?php echo $porcoes->prod_ID ?>">
                    <button class="btn btn-danger">
                      <i class="fas fa-shopping-cart"></i>
                    </button>
                  </a>
                </div>

              </div>

            </div>
          <?php } ?>
          <!-- /PORÇÕES -->

        </div>
        <div class="col"></div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){

        $('.comprarProduto').click(function(){

          var produto = $(this).attr('data-id_porcao');
            
            $.ajax({
              url : "comprar.php",
              type : 'post',
              data : {
                   prod : produto
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