<?php 

  require_once 'core/Sessao.php';
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
    <title>Cardápio</title>
    <link rel="shortcut icon" href="img/favicon.ico" />
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">

    <!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

  </head>
  <body>

    <?php include_once 'sidebar_includes/menu.php'; ?>
    
    <div class="container-fluid">
      <div class="row">
        <a href="pizzas.php" style="width: 100%;">
        	<div id="pizzas">
	        	<center>
	        		<h1 id="cardapioItens" style="padding-top: 5%; color: white;">Pizzas</h1>
	        		<span>Melhores ingredientes, melhores pizzas.</span>
	        	</center>
        	</div>
        </a>

        <a href="bebidas.php" style="width: 100%;">
        	<div id="bebidas">
        		<center>
        			<h1 id="cardapioItens" style="padding-top: 5%; color: white;">Bebidas</h1>
	        		<span>Sucos, Refrigerantes e Vinhos.</span>
        		</center>
        	</div>
        </a>

        <a href="porcoes.php" style="width: 100%;">
          <div id="porcoes">
            <center>
              <h1 id="cardapioItens" style="padding-top: 5%; color: white;">Porções</h1>
              <span>Batata-frita, macaxeira-frita e salgados.</span>
            </center>
          </div>
        </a>

      </div>
    </div>

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->
  </body>
</html>