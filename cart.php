<?php 

	require_once 'core/Sessao.php';
	require_once 'core/util.php';

	if (!Sessao::estaLogado()) {
		header('Location: login.php');
	}

	$sessao = @$_SESSION['pedido'];
	$consulta = $pdo->prepare('SELECT * FROM carrinho_temporario WHERE temporario_sessao = :ses');
	$consulta->bindValue(':ses', $sessao);
	$consulta->execute();

	$linhas = $consulta->rowCount();

 ?>
 <!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#bd2130">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="img/favicon.ico">
		<title>Carrinho de Compras</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
		<link href="css/form-validation.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/solid.css" integrity="sha384-wnAC7ln+XN0UKdcPvJvtqIH3jOjs9pnKnq9qX68ImXvOGz2JuFoEiCjT8jyZQX2z" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/fontawesome.css" integrity="sha384-HbmWTHay9psM8qyzEKPc8odH4DsOuzdejtnr+OFtDmOcIVnhgReQ4GZBH7uwcjf6" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="css/toast.css">
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
				<div class="col-md-8">

					<?php if ($linhas >= 1): ?>

						<h4 class="d-flex justify-content-between align-items-center mb-3">
							<span class="text-muted" style="color: white !important;">Meu carrinho</span>
							<span class="badge badge-secondary badge-pill"><?php echo $linhas; ?></span>
						</h4>
						<ul class="list-group mb-3">
							<?php
								$valor = 0;
								foreach ($consulta as $mostra) {
									$valor += $mostra['temporario_preco']*$mostra['temporario_quantidade'];
							 ?>

							<li class="list-group-item d-flex justify-content-between lh-condensed">

								<!-- Imagem e nome dos itens -->
								<div id="info_pedido">
									<div id="img">
										<img class="img-fluid" src="img/produtos/<?php echo $mostra['temporario_img']; ?>">
									</div>
									<h6 class="my-0" id="nome_produto"><?php echo $mostra['temporario_nome']; ?></h6>
									<a class="removerProduto" data-id_produto="<?php echo $mostra['ID']; ?>" href>
										<i class="fas fa-trash-alt" style="color: black;"></i>
									</a>
								</div>

								<!-- Quantidade e preço dos itens -->
								<div class="qtd_item mb-3">
									<a class="qtd_menos" href data-id="<?php echo $mostra['temporario_produto']; ?>">-</a>

									<input type="hidden" id="tipo_produto_<?php echo $mostra['temporario_produto']; ?>" value="<?php echo $mostra['temporario_produto']; ?>">
									<input class="mb-2" id="quantidade_<?php echo $mostra['temporario_produto']; ?>" type="text" value="<?php echo $mostra['temporario_quantidade']; ?>">

									<a class="qtd_mais" href data-id="<?php echo $mostra['temporario_produto']; ?>">+</a>
									<br>
									<span class="preco_item">
										R$ <?php echo decimalTela($mostra['temporario_preco']*$mostra['temporario_quantidade']); ?>
									</span>
								</div>

							</li>
							<?php } ?>

							<!-- Valor final do pedido -->
							<li class="list-group-item d-flex justify-content-between">

								<?php if (isset($_SESSION['frete'])): ?>
									<span style="color: #212529; font-family: lato;">Total <span class="text-muted">com frete incluso</span></span>
									<strong style="font-family: lato;">R$ <?php echo decimalTela($valor+400); ?></strong>
								<?php else: ?>
									<span style="color: #212529; font-family: lato;">Total</span>
									<strong style="font-family: lato;">R$ <?php echo decimalTela($valor); ?></strong>
								<?php endif ?>

							</li>

						</ul>

						<button class="btn btn-success btn-lg btn-block btn-finalizar rounded-0" type="submit" data-pedido="<?php echo $mostra['temporario_sessao']; ?>">Finalizar pedido</button>

						<center class="mt-3 mb-3">
							<a href="cardapio.php">
								<i class="fas fa-reply" style="color: #007bff;"></i> CONTINUAR COMPRANDO
							</a>
						</center>

					<?php else: ?>

						<div id="carrinho-vazio" class="text-center">
							<img src="img/carrinho-vazio.png">
							
							<a href="cardapio.php">
								<i class="fas fa-reply" style="color: #007bff;"></i> CONTINUAR COMPRANDO
							</a>
						</div>

					<?php endif ?>

				</div>
				<div class="col"></div>
			</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-rc.2/js/materialize.min.js"></script>
		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->

		<script type="text/javascript">
		$(document).ready(function(){

			// FINALIZAR PEDIDO
			$('.btn-finalizar').click(function(){

					var id_sessao = $(this).attr('data-pedido');
					
					$.ajax({
						url: "finalizar-pedido.php",
						type: 'post',
						data: {
								 ref: id_sessao
						},
						success: function(data){
							 if (data == 1) {
									window.location = 'pedido-realizado.php?pedido='+id_sessao;
							 } else {
									M.toast({html: 'Erro ao finalizar pedido!', classes: 'red'});
							 } 
						}//success
					});//ajax
			});//.btn-finalizar

			// Aumentar quantidade
			$('.qtd_mais').click(function(){

					var id = $(this).attr('data-id');
					var quantidade = $('#quantidade_'+id).val();
					quantidade++;

					var tipo_produto = $('#tipo_produto_'+id).val();
					
					$.ajax({
						url: 'core/qtd.php',
						type: 'POST',
						data: {
								 quantidade: quantidade,
								 tipo_produto: tipo_produto
						},
						success: function(data){
							 if (data == 1) {
								$('#quantidade_'+id).html(quantidade);
							 }
						}
					});
					return true;
			});

			// Diminuir quantidade
			$('.qtd_menos').click(function(){

					var id = $(this).attr('data-id');
					var quantidade = $('#quantidade_'+id).val();
					quantidade--;

					var tipo_produto = $('#tipo_produto_'+id).val();
					
					$.ajax({
						url: 'core/qtd.php',
						type: 'POST',
						data: {
								 quantidade: quantidade,
								 tipo_produto: tipo_produto
						},
						success: function(data){
							if (data == 1) {
								$('#quantidade_'+id).html(quantidade);
							}
						}
					});
					return true;
			});


			// REMOVER PRODUTO DO CARRINHO
			$('.removerProduto').click(function(){

					var produto = $(this).attr('data-id_produto');
					
					$.ajax({
						url: "remover.php",
						type: 'post',
						data: {
								 prod: produto
						},
						success: function(data){
							 if (data == 1) {
							 	
							 } else {

							 } 
						}
					});
			});

		});
		</script>

	</body>
</html>
