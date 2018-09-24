<?php

  require_once 'core/Sessao.php';
  require_once 'core/util.php';

  if (!Sessao::estaLogado()) {
      header('Location: login.php');
  }

  // Listar todas as pizzas
  $pizza = $pdo->prepare('SELECT * FROM pizzas ORDER BY id ASC');
  $pizza->execute();

  $pizza = $pizza->fetchAll(PDO::FETCH_OBJ);

?>
 <!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#bd2130">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.ico">
    <title>Monte sua Pizza</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
    <style type="text/css">
      h4{color: white;}label{color: white;}
      #img-prod{
        float: left;
        width: 60px;
        margin-left: -5px;
        margin-top: 1px;
        display: inline !important;
      }
    </style>
    <link rel="stylesheet" type="text/css" href="sidebar_includes/css/b4_sidebar.css">

  </head>

  <body>

    <div class="container-fluid">
      <div class="row" >
        <nav class="navbar navbar-expand-lg navbar-light bg-danger sidebarNavigation" data-sidebarClass="navbar-light bg-danger" style=" width: 100%; position: absolute; z-index: 9999; background-color: #bd2130 !important;">
              <button class="navbar-toggler leftNavbarToggler" type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarMenu">
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

        <div class="col-md-6">

          <form>
            <!-- ESCOLHER TAMANHO DA PIZZA -->
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <label class="input-group-text" for="tamanhoPizza">Tamanho</label>
              </div>
              <select class="custom-select" id="tamanhoPizza">
                <option value="0" selected>Escolha o tamanho</option>
                <option value="1">GG</option>
                <option value="2">G</option>
                <option value="3">M</option>
                <option value="4">P</option>
              </select>
            </div>

            <!-- ESCOLHER SABORES DA PIZZA -->
            <div class="input-group mb-3" id="saborPizza" style="visibility: hidden;">
              <div class="input-group-prepend">
                <label class="input-group-text" for="saboresPizza">Sabores</label>
              </div>
              <select class="custom-select" id="saboresPizza">
                <option value="0" selected disabled>Quantidade de sabores</option>
                <option value="2">1 Sabor</option>
                <option value="1">2 Sabores</option>
              </select>
            </div>
              <!-- PIZZA -->
              <div id="pizzaInfo" class="text-center mt-4">

                <!-- <img data-toggle="modal" data-target="#modalSabores" src="img/forma.png" class="img-fluid" id="forma1">

                Image Map Generated by http://www.image-map.net/
                <img src="img/forma2.png" usemap="#image-map" style="display: none;" id="img_forma2" style="height: 270px; width: 270px;">  -->

                <!-- <map name="image-map">
                  <area data-toggle="modal" data-target="#modalSabores" alt="Clique para adicionar o primeiro sabor" title="Clique para adicionar o primeiro sabor" href="" coords="132,13,134,269,101,266,65,250,41,232,19,206,4,167,1,138,1,113,7,92,23,61,43,36,72,14,102,4,130,1" shape="poly">
                  <area data-toggle="modal" data-target="#modalSabores" alt="Clique para adicionar o segundo sabor" title="Clique para adicionar o segundo sabor" href="" coords="132,0,134,267,150,269,175,264,197,255,218,241,235,226,249,207,260,189,268,162,269,136,267,105,256,76,235,44,211,23,173,5" shape="poly">
                </map> -->

                <div>
                  <img style="cursor: pointer;" class="img-fluid" id="forma1" img data-toggle="modal" data-target="#modalSabores" src="img/forma.png" class="img-fluid" id="forma1">
                </div>

                <div style="display: none; width: 100%" id="img_forma2" >

                  <div style="width: 50%; float: left; text-align: right;" >
                    <img id="parte1" data-toggle="modal" data-target="#modalSabores" alt="Clique para adicionar o primeiro sabor" title="Clique para adicionar o primeiro sabor" href="" src="img/metadeesquerda.png" style="cursor: pointer;
                    ">
                  </div>

                  <div style="width: 50%; float: right; text-align: left;">
                    <img id="parte2" data-toggle="modal" data-target="#modalSabores" alt="Clique para adicionar o segundo sabor" title="Clique para adicionar o segundo sabor" href="" src="img/metadedireita.png" style=" cursor: pointer;">
                  </div>

                </div>

                <span class="text-center mt-3 d-block"  id="preco">Preço da pizza: R$ 0,00</span>
              </div>

            <a href="" id="finalizar">
              <i class="fas fa-shopping-cart"></i>
                Adicionar ao Pedido
            </a>
          </form>

        </div>

        <div class="col"></div>
      </div>

      <!-- SABORES -->
      <div class="modal fade" id="modalSabores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-parteClicada="">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header bg-danger text-white">
              <h5 class="modal-title" id="exampleModalLabel">Selecione um Sabor</h5>
            </div>
            <div class="modal-body">

              <!-- BUSCAR SABORES -->
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pesquisar sabor..." aria-describedby="button-addon2">
                <div class="input-group-append">
                  <button class="btn btn-outline-light" type="button" id="button-addon2">
                    <i class="fas fa-search" style="color: black;"></i>
                  </button>
                </div>
              </div>
              <hr class="mb-3">
              <!-- /BUSCAR SABORES -->

              <!-- LISTA DE SABORES -->
              <?php foreach ($pizza as $pizza) { ?>
              <div class="card w-75" style="margin-bottom: 10px;">
                <a href="#" class="escolha-sabor">
                <div class="card-body">
                  <img id="img-prod" src="img/produtos/uploads/<?php echo $pizza->img_pizza; ?>" class="img-fluid" data-imagem="<?php echo $pizza->img_pizza; ?>" data-preco="<?php echo $pizza->preco; ?>">
                  <h5 class="card-title"><?php echo $pizza->sabor; ?> - R$ <?php echo decimalTela($pizza->preco); ?></h5>
                  <p class="card-text"><?php echo $pizza->descricao; ?></p>
                </div>
                </a>
              </div>
              <?php } ?>
              <!-- /LISTA DE SABORES -->

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>
            </div>
          </div>
        </div>
      </div>
      <!-- /SABORES -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="sidebar_includes/js/b4_sidebar.js"></script>

    <script type="text/javascript">
      $(document).ready(function () {

        var preco1;
        var preco2;

        $('#parte1').click(function(){
          $('#modalSabores').attr('data-parteClicada','parte1');
        });

        $('#parte2').click(function(){
          $('#modalSabores').attr('data-parteClicada','parte2');
        });

        $('.escolha-sabor img').click(function(){
          //alert($(this).attr('data-preco'));

          if ($('#modalSabores').attr('data-parteClicada') == 'parte1') {
            $('#parte1').attr('src','img/produtos/uploads/'+$(this).attr('data-imagem'));
            preco1 = $(this).attr('data-preco');
          } else {
            $('#parte2').attr('src','img/produtos/uploads/'+$(this).attr('data-imagem'));
            preco2 = $(this).attr('data-preco');

            if (preco1>preco2) {
             $('#preco').html(preco1);
            }else{
              $('#preco').html(preco2);
            }
          }

          

        });

        $('#tamanhoPizza').click(function(){
          if ($('#tamanhoPizza').val() != '4' && $('#tamanhoPizza').val() != '0') {
            $('#saborPizza').css('visibility', 'visible'); // Deixa o select de sabor visivel caso não seja uma pizza pequena

          }else if($('#tamanhoPizza').val() == '4'){
            $('#saborPizza').css('visibility', 'hidden'); // Deixa o select de sabor invisivel caso seja uma pizza pequena

            $('.img-fluid').css('display', 'inline'); // Mostra a forma de 1 sabor
            $('#pizzaInfo map').css('display', 'none'); // Esconde a forma de 2 sabores
            $('#pizzaInfo #img_forma2').css('display', 'none'); // Esconde a forma de 2 sabores
            
          }else{
            $('#saborPizza').css('visibility', 'hidden'); // Deixa o select de sabor invisivel caso seja uma pizza pequena 
          }

        });

        $('#saboresPizza').click(function(){
          if ($('#saboresPizza').val() == '1' || $('#saboresPizza').val() == '0') {
            $('.img-fluid').css('display', 'none'); // Esconde a forma de 2 sabores
            $('#pizzaInfo map').css('display', 'inline'); // Mostra a forma de 2 sabores
            $('#pizzaInfo #img_forma2').css('display', 'inline'); // Mostra a forma de 2 sabores
          }else{
            $('.img-fluid').css('display', 'inline'); // Esconde a forma de 2 sabores
            $('#pizzaInfo map').css('display', 'none'); // Mostra a forma de 2 sabores
            $('#pizzaInfo #img_forma2').css('display', 'none'); // Mostra a forma de 2 sabores
          }
        });

      });
    </script>

  </body>
</html>
