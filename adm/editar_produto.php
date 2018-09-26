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

<div class="container-fluid">
	<div class="row" >
		<div class="col-sm-12" style="background-color: #ff8a00 !important; height: 60px; position: absolute; z-index: 9999;">
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
						<input name="txtPrecoProduto" type="txt" class="form-control money" id="txtPrecoProduto" maxlength="6" value="<?php echo decimalTela($produto->prod_preco); ?>">
					</div>

					<div class="form-group col-md-6">
						<label>Tipo de Produto</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="tiposProduto">Tipos</label>
							</div>
							<select class="custom-select" id="txt_tipo" name="txt_tipo" id="tiposProduto">
								<option value="<?php echo $produto->prod_tipo; ?>" selected><?php echo $produto->prod_tipo; ?></option>
								<option value="Bebidas">Bebidas</option>
								<option value="Porcoes">Porções</option>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="upload">Imagem do produto</label>
					<input type="file" class="form-control" name="prod_img" id="upload" value="<?php echo $produto->prod_img; ?>">
					<img id="img" style="width: 15%">
				</div>

				<input type="hidden" name="img_prod-salvo" value="<?php echo $produto->prod_img; ?>">

				<button type="submit" id="btn-salvar" class="btn btn-success">Salvar</button>
			</form>

		</div>
		<div class="col"></div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>

<script type="text/javascript">

	$('.money2').mask("0.000,00", {reverse: true});
	
	$('#upload_pizza').change(function(){
		const file = $(this)[0].files[0];
		const fileReader = new FileReader();
		fileReader.onloadend = function() {
			$('#img_promo').attr('src', fileReader.result);
		}
		fileReader.readAsDataURL(file);
	});

</script>