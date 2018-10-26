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

	$pizza2 = $pdo->prepare('SELECT * FROM pizzas ORDER BY sabor ASC');
	$pizza2->execute();

	$pizza2 = $pizza2->fetchAll(PDO::FETCH_OBJ);

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
		<link rel="stylesheet" type="text/css" href="css/toast.css">
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
		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

	</head>

	<body>
		<div class="container-fluid">
			<div class="row">
				<?php include_once 'sidebar_includes/menu.php'; ?>
			</div>

			<div class="row" id="cart">
				<div class="col"></div>

				<div class="col-md-6">

					<form id="formPizza" method="post" action="">
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
								<option value="1">1 Sabor</option>
								<option value="2">2 Sabores</option>
							</select>
						</div>

						<!-- PIZZA -->
						<div id="pizzaInfo" class="text-center mt-4" data-preco="" data-preco2="" data-sabor="" data-sabor2="" data-imagem="" data-imagem2="">

							<div id="divforma1">
								<img style="cursor: pointer; display: none;" class="img-fluid parte1" id="forma1" img data-toggle="modal" data-target="#modalSabores" src="img/forma.png" name="img_pizza">
							</div>

							<div style="display: none; width: 100%" id="img_forma2" >
								<div style="width: 50%; float: left; text-align: right;" >
									<img id="parte1" data-toggle="modal" data-target="#modalSabores" alt="Clique para adicionar o primeiro sabor" title="Clique para adicionar o primeiro sabor" src="img/metadeesquerda.png" style="cursor: pointer;
									">
								</div>

								<div style="width: 50%; float: right; text-align: left;">
									<img id="parte2" data-toggle="modal" data-target="#modalSabores2" alt="Clique para adicionar o segundo sabor" title="Clique para adicionar o segundo sabor" src="img/metadedireita.png" style="cursor: pointer;">
								</div>
							</div>

							<input type="hidden" name="valorfinal" id="valorfinal" value="">
							<input type="hidden" name="saborpizza" id="saborpizza" value="">
							<input type="hidden" name="saborpizza2" id="saborpizza2" value="">
							<input type="hidden" name="imagem_pizza" id="imagem_pizza" value="">
							<input type="hidden" name="qtdsabores" id="qtdsabores" value="">
						</div>

						<!-- Sabores e preço da pizza -->
						<div style="width: 100%; height: 50px; background-color: transparent; clear: both; text-align: center; position: fixed; left: 0; bottom: 100px;">
							<!-- Sabores da pizza -->
							<span class="d-inline-block">Sabores: </span>
							<span id="sabor1"></span>
							<span id="barra_sabor"></span>
							<span id="sabor2"></span>

							<!-- Preço da pizza -->
							<span class="d-block">Preço da pizza: R$ <span id="preco"> 0,00</span></span>
						</div>

						<a id="finalizar" class="btn comprarPizza">
							<i class="fas fa-shopping-cart"></i>
								Adicionar ao Pedido
						</a>
					</form>

				</div>

				<div class="col"></div>
			</div>
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

							<!-- PIZZA P -->
							<div id="pizzap" class="card w-75 pizzap" style="margin-bottom: 10px; display: none;">
								<a href="#" class="escolha-sabor" data-id="<?php echo $pizza->id; ?>" style="color: black;" data-imagem="<?php echo $pizza->img_pizza; ?>" data-preco="<?php echo $pizza->precop; ?>" data-sabor="<?php echo $pizza->sabor; ?>">
								<div class="card-body" data-dismiss="modal">
									<img id="img-prod" src="img/produtos/<?php echo $pizza->img_pizza; ?>" class="img-fluid">
									<h5 class="card-title"><?php echo $pizza->sabor; ?> - R$ <?php echo decimalTela($pizza->precop); ?></h5>
									<p class="card-text"><?php echo $pizza->descricao; ?></p>
								</div>
								</a>
							</div>

							<!-- PIZZA M -->
							<div id="pizzam" class="card w-75 pizzam" style="margin-bottom: 10px; display: none;">
								<a href="#" class="escolha-sabor" data-id="<?php echo $pizza->id; ?>" style="color: black;" data-imagem="<?php echo $pizza->img_pizza; ?>" data-preco="<?php echo $pizza->precom; ?>" data-sabor="<?php echo $pizza->sabor; ?>">
								<div class="card-body" data-dismiss="modal">
									<img id="img-prod" src="img/produtos/<?php echo $pizza->img_pizza; ?>" class="img-fluid">
									<h5 class="card-title"><?php echo $pizza->sabor; ?> - R$ <?php echo decimalTela($pizza->precom); ?></h5>
									<p class="card-text"><?php echo $pizza->descricao; ?></p>
								</div>
								</a>
							</div>

							<!-- PIZZA G -->
							<div id="pizzag" class="card w-75 pizzag" style="margin-bottom: 10px; display: none;">
								<a href="#" class="escolha-sabor" data-id="<?php echo $pizza->id; ?>" style="color: black;" data-imagem="<?php echo $pizza->img_pizza; ?>" data-preco="<?php echo $pizza->precog; ?>" data-sabor="<?php echo $pizza->sabor; ?>">
								<div class="card-body" data-dismiss="modal">
									<img id="img-prod" src="img/produtos/<?php echo $pizza->img_pizza; ?>" class="img-fluid" >
									<h5 class="card-title"><?php echo $pizza->sabor; ?> - R$ <?php echo decimalTela($pizza->precog); ?></h5>
									<p class="card-text"><?php echo $pizza->descricao; ?></p>
								</div>
								</a>
							</div>

							<!-- PIZZA GG -->
							<div id="pizzagg" class="card w-75 pizzagg" style="margin-bottom: 10px; display: none;">
								<a href="#" class="escolha-sabor" data-id="<?php echo $pizza->id; ?>" style="color: black;" data-imagem="<?php echo $pizza->img_pizza; ?>" data-preco="<?php echo $pizza->precogg; ?>" data-sabor="<?php echo $pizza->sabor; ?>">
								<div class="card-body" data-dismiss="modal">
									<img id="img-prod" src="img/produtos/<?php echo $pizza->img_pizza; ?>" class="img-fluid">
									<h5 class="card-title"><?php echo $pizza->sabor; ?> - R$ <?php echo decimalTela($pizza->precogg); ?></h5>
									<p class="card-text"><?php echo $pizza->descricao; ?></p>
								</div>
								</a>
							</div>

							<?php } ?>

						</div>
					</div>
				</div>
			</div>
			<!-- /SABORES -->

			<!-- SABORES 2-->
			<div class="modal fade" id="modalSabores2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-parteClicada="">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header bg-danger text-white">
							<h5 class="modal-title" id="exampleModalLabel">Selecione o segundo Sabor</h5>
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
							<?php foreach ($pizza2 as $pizza2) { ?>

							<!-- PIZZA M -->
							<div id="pizzam" class="card w-75 pizzam" style="margin-bottom: 10px; display: none;">
								<a href="#" class="escolha-sabor2" data-id="<?php echo $pizza2->id; ?>" style="color: black;" data-imagem2="<?php echo $pizza2->img_pizza; ?>" data-preco2="<?php echo $pizza2->precom; ?>" data-sabor2="<?php echo $pizza->sabor; ?>">
								<div class="card-body" data-dismiss="modal">
									<img id="img-prod" src="img/produtos/<?php echo $pizza->img_pizza; ?>" class="img-fluid">
									<h5 class="card-title"><?php echo $pizza2->sabor; ?> - R$ <?php echo decimalTela($pizza2->precom); ?></h5>
									<p class="card-text"><?php echo $pizza2->descricao; ?></p>
								</div>
								</a>
							</div>

							<!-- PIZZA G -->
							<div id="pizzag" class="card w-75 pizzag" style="margin-bottom: 10px; display: none;">
								<a href="#" class="escolha-sabor2" data-id="<?php echo $pizza2->id; ?>" style="color: black;" data-imagem2="<?php echo $pizza2->img_pizza; ?>" data-preco2="<?php echo $pizza2->precog; ?>" data-sabor2="<?php echo $pizza2->sabor; ?>">
								<div class="card-body" data-dismiss="modal">
									<img id="img-prod" src="img/produtos/<?php echo $pizza->img_pizza; ?>" class="img-fluid" >
									<h5 class="card-title"><?php echo $pizza2->sabor; ?> - R$ <?php echo decimalTela($pizza2->precog); ?></h5>
									<p class="card-text"><?php echo $pizza2->descricao; ?></p>
								</div>
								</a>
							</div>

							<!-- PIZZA GG -->
							<div id="pizzagg" class="card w-75 pizzagg" style="margin-bottom: 10px; display: none;">
								<a href="#" class="escolha-sabor2" data-id="<?php echo $pizza2->id; ?>" style="color: black;" data-imagem2="<?php echo $pizza2->img_pizza; ?>" data-preco2="<?php echo $pizza2->precogg; ?>" data-sabor2="<?php echo $pizza2->sabor; ?>">
								<div class="card-body" data-dismiss="modal">
									<img id="img-prod" src="img/produtos/<?php echo $pizza->img_pizza; ?>" class="img-fluid" >
									<h5 class="card-title"><?php echo $pizza2->sabor; ?> - R$ <?php echo decimalTela($pizza2->precogg); ?></h5>
									<p class="card-text"><?php echo $pizza2->descricao; ?></p>
								</div>
								</a>
							</div>

							<?php } ?>

						</div>
					</div>
				</div>
			</div>
			<!-- /SABORES 2-->

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->
		<script src="js/funcoes_pizza.js"></script>

		<script type="text/javascript">
			var id_pizza = 0;

			$('.escolha-sabor').click(function(){

				id_pizza = $(this).attr('data-id');

			});

			$('#finalizar').click(function(){

				var valorFinal = $('#valorfinal').val();
				var tamanhoPizza = $('#tamanhoPizza').val();
				var saborPizza = $('#saborpizza').val();
				var saborPizza2 = $('#saborpizza2').val();
				var imagem_pizza = $('#imagem_pizza').val();
				var qtd_sabores = $('#qtdsabores').val();
				
				$.ajax({
				  url: 'comprarPizza.php',
				  type: 'POST',
				  data: {
					   id: id_pizza,
					   qtd_sabores: qtd_sabores,
					   valor: valorFinal,
					   tamanho: tamanhoPizza,
					   sabor: saborPizza,
					   sabor2: saborPizza2,
					   img: imagem_pizza
				  },
				  success: function(data){
					 if (data == 1) {
						M.toast({html: 'O Produto foi adicionado ao carrinho.'});
					 } else if(data == 2){
						M.toast({html: 'Foi adicionado mais uma unidade desse produto!'});
					 } else {
						M.toast({html: 'O Produto não pôde ser adicionado ao carrinho.', classes: 'red'});
					 } 
				  }//success
				});//ajax
				return true;
			});//#comprarProduto
		</script>

	</body>
</html>
