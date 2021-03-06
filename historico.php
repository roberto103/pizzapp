<?php 

    require_once 'core/Sessao.php';
    require_once 'core/conexao.php';
    require_once 'core/util.php';

    if (!Sessao::estaLogado()) {
        header('Location: login.php');
    }

    $sessao = @$_SESSION['pedido'];

    $sql = $pdo->prepare('SELECT * FROM pedidos WHERE sessao = :sessao ORDER BY id DESC');
    $sql->bindValue(':sessao', $sessao);
    $sql->execute();

    $linhas = $sql->rowCount();

    $carrinho = $sql->fetchAll(PDO::FETCH_OBJ);

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>


  </head>
  <body>

    <?php include_once 'sidebar_includes/menu.php'; ?>

    <div class="container-fluid"> <!-- div container-fluid -->      
      <div class="row"> <!-- div row -->
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
      </div> <!-- div row -->

      <div class="row">
        <div class="col"></div>

        <div class="col-md-6">
        <?php if ($linhas == 0): ?> <!-- Carrinho vazio -->
          
          <div id="carrinho-vazio" class="text-center mt-4">
            <img src="img/carrinho-vazio.png">
            
            <a href="cardapio.php">
              <i class="fas fa-reply" style="color: #007bff;"></i> CONTINUAR COMPRANDO
            </a>
          </div> <!-- Carrinho vazio -->

        <?php else: ?> <!-- carrinho com itens -->
          <?php foreach ($carrinho as $cart) { ?> <!-- Abrindo o foreach -->
          <div class="card mt-3">
            <div class="card-body">

              <h6 class="card-title mb-4">Pedido nº <?php echo $cart->id; ?> as <?php echo dataTela($cart->hora); ?>h</h6>
              Status: <p class="card-text text-success d-inline"><?php echo $cart->status; ?></p>
              <hr class="mb-3">
              <a style="color: white;" id="vizualizar" data-toggle="modal" data-target="#modal-mostrar_pedido" class="btn btn-primary btn-mostrar_pedido" data-id="<?php echo $cart->id; ?>" data-id_pedido="<?php echo $cart->produto_id; ?>" data-pedido="<?php echo $cart->sessao; ?>" data-qtd="<?php echo $cart->quantidade; ?>" data-valor="<?php echo decimalTela($cart->valor_total); ?>" data-desc="<?php echo $cart->descricao; ?>" data-hora="<?php echo $cart->hora; ?>" data-status="<?php echo $cart->status; ?>">Visualizar pedido <i class="fas fa-arrow-right"></i></a>
              <a href="pedido-realizado.php?ref=<?php echo $sessao; ?>" class="btn btn-primary">Acompanhar</a>
              
            </div>
          </div> 
        <?php } ?> <!-- /Fechando o foreach -->
                    <!-- /carrinho com itens -->

        <?php endif ?>
        </div>

        <div class="col"></div>
      </div>

    </div> <!-- /div container fluid -->
    <!-- mostrar o pedido -->

    <div class="modal fade bd-example-modal-lg" id="modal-mostrar_pedido" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9999 !important;">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Pedido número:</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-dark" aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <h5>Produtos:</h5>
                  <span id="descricao" style="color: black;"></span>
                  <hr>

                  <h5 class="mt-3 d-inline">Valor total:</h5>
                  <span id="valor" style="color: black;"></span>

                  <h5 class="mt-3 d-inline ml-3">Hora:</h5>
                  <span id="hora" style="color: black;"></span>
                  <hr>

                  <h5 class="d-inline">Status:</h5>
                  <span id="status" class="text-success"></span>

                </div>
              </div>
            </div>
          </div>
          <!-- /mostrar o pedido -->

    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>


    <script type="">

      $('#modal-mostrar_pedido').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var recipient_id = button.data('id') // Extract info from data-* attributes
        var recipient_preco = button.data('valor')
        var recipient_desc = button.data('desc')
        var recipient_hora = button.data('hora')
        var recipient_status = button.data('status')
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-title').text('Pedido: ' + recipient_id)

        modal.find('#descricao').html(recipient_desc)
        modal.find('#valor').html(recipient_preco)
        modal.find('#hora').html(recipient_hora)
        modal.find('#status').html(recipient_status)
      })

    </script>

  </body>
</html>