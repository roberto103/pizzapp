<?php
	
	require_once 'core/Sessao.php';
	require_once 'core/conexao.php';

	if (!Sessao::estaLogado()) {
		header('Location: login.php');
	}

	// Listar todas as pizzas
	$p = $pdo->prepare('SELECT * FROM pizzas WHERE id = :id ORDER BY id ASC');
	$p->bindvalue(':id',$_GET['id']);
	$p->execute();

	$p = $p->fetch(PDO::FETCH_OBJ);

 ?>

<title>Editar Pizza</title>
<link rel="shortcut icon" href="../img/favicon.ico" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="css/style.css">

<div class="container-fluid">

	<div class="row" >
		<div class="col-sm-12" style="background-color: #ff8a00 !important; height: 60px; position: absolute; z-index: 998;">
		</div> 
	</div>
	<div class="row mb-4">
		 <div class="col-sm-12" style="height: 100px; background-color: #343a40; color: white;">
			<div style="float: left;">
				<span>
					<i class="fas fa-user-alt" style="margin-top: 70px;"></i>
				</span>
			</div>
			<h6 style="margin-top: 68px; display: inline-block; margin-left: 15px; text-transform: capitalize;">Olá, <?php echo $_SESSION['nome_adm']; ?>!</h6>
			<div style="display: inline-block; float: right;">
				<a href="core/doLogout.php">
					<i class="fas fa-sign-out-alt" style="margin-top: 70px;"></i>
				</a>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10" id="novo-produto" style="padding: 0;">

			<h4 class="display-4" style="font-size: 2.5rem; display: inline;">Pizzas</h4>
			<a href="index.php">
				<button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Todas as pizzas</button>
			</a>
			<hr class="mb-4">
			

			<!-- novo produto -->
			<form method="POST" action="salvar_editar_pizza.php" enctype="multipart/form-data" style="padding-bottom: 20px;">

				<input type="hidden" name="id" value="<?php echo $p->id; ?>">

				<div class="form-group">
					<label for="txtSaborPizza">Sabor</label>
					<input type="text" class="form-control" id="txtSaborPizza" name="txtSaborPizza" placeholder="Nome da pizza" value="<?php echo $p->sabor; ?>">
				</div>

				<div class="row mb-3">
					<div class="col">
						<label for="txtPrecoPizza">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza P</small>
						<input value="<?php echo decimalTela($p->precop); ?>" type="text" class="form-control money2" id="txtPrecoPizza" name="txtPrecoPizzap" placeholder="Preço da pizza">
					</div>

					<div class="col">
						<label for="txtPrecoPizza">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza M</small>
						<input value="<?php echo decimalTela($p->precom); ?>" type="text" class="form-control money2" id="txtPrecoPizza" name="txtPrecoPizzam" placeholder="Preço da pizza">
					</div>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label for="txtPrecoPizza">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza G</small>
						<input value="<?php echo decimalTela($p->precog); ?>" type="text" class="form-control money2" id="txtPrecoPizza" name="txtPrecoPizzag" placeholder="Preço da pizza">
					</div>

					<div class="col">
						<label for="txtPrecoPizza">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza GG</small>
						<input value="<?php echo decimalTela($p->precogg); ?>" type="text" class="form-control money2" id="txtPrecoPizza" name="txtPrecoPizzagg" placeholder="Preço da pizza">
					</div>
				</div>

				<div class="form-group">
					<label for="txtDescricaoPizza">Descrição</label>
					<textarea class="form-control" id="txtDescricaoPizza" name="txtDescricaoPizza" placeholder="Descrição da pizza"><?php echo $p->descricao; ?></textarea>
				</div>

				<div class="form-group" id="form-group_pizzas">
					<label for="upload" style="display: block;">Imagem da pizza</label>

					<img class="d-block img mb-4" id="img" style="width: 15%">

					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensPizzas">Selecionar imagem</button>
				</div>

				<input class="form-control" type="hidden" name="img_pizza" id="upload">

				<button type="submit" class="btn btn-outline-success" style="width: 100%;">Adicionar</button>
			</form>

		</div>
	</div>
</div>

<!-- MODAL DAS IMAGENS PIZZAS -->
<div class="modal fade bd-example-modal-lg" id="modalImagensPizzas" tabindex="-1" role="dialog" aria-labelledby="modallabelEx" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modallabelEx">Banco de imagens</h5>
			</div>

			<div class="modal-body">
				<div class="imagens">
				<?php 
					$pasta = '../img/produtos/pizzas/';
					$arquivos = scandir($pasta);

					foreach ($arquivos as $arquivo) {
						if (($arquivo != '.') && ($arquivo != '..')) {
				 ?>
					<img data-dismiss="modal" src="<?php echo $pasta.$arquivo; ?>" class="img-fluid img-pizzas" data-nome="<?php echo $arquivo;?>">
				<?php }} ?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- /MODAL DAS IMAGENS PIZZAS-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>

<script type="text/javascript">

	$('.img-pizzas').click(function(){
		var img_nome = $(this).attr('data-nome');
		$('.img').attr('src', '../img/produtos/pizzas/'+img_nome);
		$('#upload').val('pizzas/'+img_nome)
	});

</script>