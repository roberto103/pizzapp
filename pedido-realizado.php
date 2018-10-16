<?php 

  session_start();
  require_once 'core/conexao.php';

  $sessao = $_SESSION['pedido'];
  
  $sql = $pdo->prepare('SELECT * FROM pedidos WHERE sessao = :sessao');
  $sql->bindValue(':sessao', $sessao);
  $sql->execute();

  $registros = $sql->fetch(PDO::FETCH_OBJ);
  
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#bd2130">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.ico">
    <title>Pedido Realizado</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
    <style type="text/css">
      span{font-size: 17px; display: block; color: black;}
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
        <div class="col-md-8 text-center">

          <div class="bg-white text-center p-3">
            <h3 style="font-weight: 400;">ACOMPANHAR PEDIDO</h3>
            <hr class="mb-3">

            <span class="text-danger">Nº do seu pedido: <b><?php echo $registros->sessao; ?></b></span>
            <span>Pedido realizado às: <b><?php echo $registros->hora; ?></b></span>

            <h5 class="mt-5 mb-3">Status do seu pedido:</h5>
            <hr class="mb-2">

            <span class="text-success">
              <i class="fas fa-check-circle text-success"></i> Recebemos seu pedido
            </span>
            <hr class="mb-2">

            <!-- PEDIDO ATENDIDO -->
            <?php if ($registros->status == 'Pedido atendido') { ?>
              <span class="text-success">
                <i class="fas fa-check-circle text-success"></i> Pedido atendido
              </span>
            <?php } elseif ($registros->status == 'Pedido pronto') { ?>
              <span class="text-success">
                <i class="fas fa-check-circle text-success"></i> Pedido atendido
              </span>
            <?php } elseif ($registros->status == 'Pedido saiu para entrega') { ?>
              <span class="text-success">
                <i class="fas fa-check-circle text-success"></i> Pedido atendido
              </span>
            <?php } else { ?>  
              <span class="text-muted">
                <i class="fas fa-check-circle text-secondary"></i> Pedido atendido
              </span>
            <?php } ?>
            <hr class="mb-2">
            <!-- /PEDIDO ATENDIDO -->

            <!-- PEDIDO PRONTO -->
            <?php if ($registros->status == 'Pedido pronto') { ?>
              <span class="text-success">
                <i class="fas fa-check-circle text-success"></i> Pedido pronto
              </span>
            <?php } elseif ($registros->status == 'Pedido saiu para entrega') { ?>
              <span class="text-success">
                <i class="fas fa-check-circle text-success"></i> Pedido pronto
              </span>
            <?php } else { ?>  
              <span class="text-muted">
                <i class="fas fa-check-circle text-secondary"></i> Pedido pronto
              </span>
            <?php } ?>
            <hr class="mb-2">
            <!-- /PEDIDO PRONTO -->

            <!-- PEDIDO SAIU PARA ENTREGA -->
            <?php if ($registros->status == 'Pedido saiu para entrega') { ?>
              <span class="text-success">
                <i class="fas fa-check-circle text-success"></i> Pedido saiu para entrega
              </span>
            <?php } else { ?>  
              <span class="text-muted">
                <i class="fas fa-check-circle text-secondary"></i> Pedido saiu para entrega
              </span>
            <?php } ?>
            <!-- /PEDIDO SAIU PARA ENTREGA -->
          </div>

        </div>
        <div class="col"></div>

      </div>

    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

  </body>
</html>