<?php 

	require_once 'core/Sessao.php';

	if (!Sessao::estaLogado()) {
		header('Location: login.php');
	}

	$valorPedido = $_POST['valor'];

?>
<!doctype html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#bd2130">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="icon" href="img/favicon.ico">
		<title>Checkout</title>
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

		<?php include_once 'sidebar_includes/menu.php'; ?>

		<div class="container-fluid">
			<div class="row" id="cart">

				<div class="col"></div>
				<div class="col-md-8">

					<h4 class="mb-3">Pagamento</h4>
					<form class="needs-validation" novalidate>

						<div class="d-block my-3">
							<div class="custom-control custom-radio">
								<input id="credito" name="paymentMethod" type="radio" class="custom-control-input" checked required>
								<label class="custom-control-label" for="credito">Cartão de crédito</label>
							</div>
							<div class="custom-control custom-radio">
								<input id="debito" name="paymentMethod" type="radio" class="custom-control-input" required>
								<label class="custom-control-label" for="debito">Cartão de débito</label>
							</div>
							<div class="custom-control custom-radio">
								<input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
								<label class="custom-control-label" for="paypal">PayPal</label>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 mb-3">
								<label for="cc-nome">Nome no cartão</label>
								<input style="text-transform: capitalize;" type="text" class="form-control" id="cc-nome" placeholder="" required>
								<small class="text-muted">Nome completo, como mostrado no cartão.</small>
								<div class="invalid-feedback">
									O nome que está no cartão é obrigatório.
								</div>
							</div>
							<div class="col-md-6 mb-3">
								<label for="cc-numero">Número do cartão de crédito</label>
								<input type="text" class="form-control cc-credit" id="cc-numero" name="cardNumber" placeholder="" required>
								<div class="invalid-feedback">
									O número do cartão de crédito é obrigatório.
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-3 mb-3">
								<label for="cc-expiracao">Data de expiração</label>
								<input type="text" class="form-control date" id="cc-expiracao" name="cardExpiry" placeholder="" required>
								<div class="invalid-feedback">
									Data de expiração é obrigatória.
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<label for="cc-cvv">CVV</label>
								<input type="text" class="form-control cvv" id="cc-cvv" name="cardCVC" placeholder="" required>
								<div class="invalid-feedback">
									Código de segurança é obrigatório.
								</div>
							</div>
						</div>

						<hr class="mb-4">

						<button class="btn btn-success btn-lg btn-block mb-2" type="submit" style="border-radius: 0;">Continue o checkout</button>

					</form>

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
		<script src="js/jquery.mask.js"></script>
		<!-- <script type="text/javascript" src="sidebar_includes/js/b4_sidebar.js"></script> -->
		<script src="pagseguro/pagseguro.js"></script>

		<script>
			$(document).ready(function(){
				$('.date').mask('00/00/0000');
				$('.cc-credit').mask('0000 0000 0000 0000');
				$('.cvv').mask('000');
			});

			// Exemplo de JavaScript para desativar o envio do formulário, se tiver algum campo inválido.
			(function() {
				'use strict';

				window.addEventListener('load', function() {
					// Selecione todos os campos que nós queremos aplicar estilos Bootstrap de validação customizados.
					var forms = document.getElementsByClassName('needs-validation');

					// Faz um loop neles e previne envio
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
