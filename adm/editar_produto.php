<?php 

	require_once 'core/Sessao.php';
	require_once 'core/conexao.php';
	require_once 'core/util.php';

	if (!Sessao::estaLogado()) {
		header('Location: login.php');
	}

	// Listar todas os produtos
	$produto = $pdo->prepare('SELECT * FROM produtos WHERE prod_ID = :prod_ID ORDER BY prod_ID ASC');
	$produto->bindvalue(':prod_ID',$_GET['prod_ID']);
	$produto->execute();

	$produto = $produto->fetch(PDO::FETCH_OBJ);

 ?>

<title>Editar Produto</title>
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
		<div class="col"></div>
		<div class="col-sm-10" id="novo-produto" style="padding: 0;">

			<h4 class="display-4" style="font-size: 2.5rem; display: inline;">Produtos</h4>
			<a href="index.php">
				<button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Todos os produtos</button>
			</a>
			<hr class="mb-4">
			
			<!-- nova promocao -->
			<form method="post" enctype="multipart/form-data" action="salvar_editar_produto.php">

				<input type="hidden" name="prodID" value="<?php echo $produto->prod_ID; ?>">
				<div class="form-group">
					<label for="txtNomeProduto">Nome do Produto</label>
					<input name="txtNomeProduto" type="txt" class="form-control" id="txtNomeProduto" value="<?php echo $produto->prod_nome; ?>" >
				</div>

				<div class="form-group">
					<label for="txtDescricaoProduto">Descrição do Produto</label>
					<textarea name="txtDescricaoProduto" class="form-control" id="txtDescricaoProduto"><?php echo $produto->prod_descricao; ?></textarea>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="txtPrecoProduto">Preço do Produto</label>
						<input name="txtPrecoProduto" type="txt" class="form-control money2" id="txtPrecoProduto" maxlength="6" value="<?php echo decimalTela($produto->prod_preco); ?>">
					</div>

					<div class="form-group col-md-6" style="display: none;">
						<label>Tipo de Produto</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="tiposProduto">Tipos</label>
							</div>
							<select class="custom-select" id="tiposProduto" name="txt_tipo" id="tiposProduto">
								<option value="<?php echo $produto->prod_tipo; ?>" selected><?php echo $produto->prod_tipo; ?></option>
								<option value="Bebidas">Bebidas</option>
								<option value="Porcoes">Porções</option>
							</select>
						</div>
					</div>
				</div>

				<?php if ($produto->prod_tipo == 'Bebidas'): ?>
					<div class="form-group" id="form-group_bebidas" style="display: ;">
						<label for="upload" style="display: block;">Imagem da bebida</label>

						<img id="img" style="width: 15%" class="d-block img">
						<br>

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensBedidas">Selecionar imagem</button>
					</div>
				<?php else: ?>
					<div class="form-group" id="form-group_porcoes" style="display: ;">
						<label for="upload" style="display: block;">Imagem da porção</label>

						<img class="d-block img" id="img" style="width: 15%">
						<br>

						<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensPorcoes">Selecionar imagem</button>
					</div>

				<?php endif ?>

				<input type="hidden" class="form-control" name="img" id="upload">
				<input type="hidden" name="imgvazia" id="imgvazia" value="<?php echo $produto->prod_img; ?>">

				<button type="submit" class="btn btn-outline-success" style="width: 100%;">Adicionar</button>
			</form>

		</div>
		<div class="col"></div>
	</div>
</div>

<!-- MODAL DAS IMAGENS BEBIDAS -->
<div class="modal fade bd-example-modal-lg" id="modalImagensBedidas" tabindex="-1" role="dialog" aria-labelledby="modallabelEx" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="modallabelEx">Banco de bebidas</h5>
	  </div>

	  <div class="modal-body">

	  	<div class="imagens">
	  		<?php 
	  			$pasta = '../img/produtos/bebidas/';
	  			$arquivos = scandir($pasta);

	  			foreach ($arquivos as $arquivo) {
	  				if (($arquivo != '.') && ($arquivo != '..')) {
	  		 ?>
	  			<img data-dismiss="modal" src="<?php echo $pasta.$arquivo; ?>" class="img-fluid img-bebidas" data-nome="<?php echo $arquivo;?>">
	  		<?php }} ?>

	  	</div>
	  </div>
	</div>
  </div>
</div>
<!-- /MODAL DAS IMAGENS BEBIDAS -->

<!-- MODAL DAS IMAGENS PORCOES -->
<div class="modal fade bd-example-modal-lg" id="modalImagensPorcoes" tabindex="-1" role="dialog" aria-labelledby="modallabelEx" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="modallabelEx">Banco de imagens</h5>
	  </div>

	  <div class="modal-body">

	  	<div class="imagens">
	  		<?php 
	  			$pasta = '../img/produtos/porcoes/';
	  			$arquivos = scandir($pasta);

	  			foreach ($arquivos as $arquivo) {
	  				if (($arquivo != '.') && ($arquivo != '..')) {
	  		 ?>
	  			<img data-dismiss="modal" src="<?php echo $pasta.$arquivo; ?>" class="img-fluid img-porcoes" data-nome="<?php echo $arquivo;?>">
	  		<?php }} ?>

	  	</div>
	  </div>
	</div>
  </div>
</div>
<!-- /MODAL DAS IMAGENS PORCOES-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>
<script type="text/javascript" src="js/funcoesadm.js"></script>

<script type="text/javascript">

	$('.money2').mask("0.000,00", {reverse: true});

</script>