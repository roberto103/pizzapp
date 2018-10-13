<div class="container-fluid">
	<div class="row">
		<div class="col-sm" id="novo-produto" style="padding: 0;">

			<h4 class="display-4" style="font-size: 2.5rem; display: inline;">Pizzas</h4>
			<a href="index.php">
				<button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Todas as pizzas</button>
			</a>
			<hr class="mb-3">
			
			<!-- novo produto -->

			<form method="POST" action="salvar_nova_pizza.php" enctype="multipart/form-data" style="padding-bottom: 20px;">

				<div class="form-group">
					<label for="txtSabor">Sabor</label>
					<input type="text" class="form-control" id="txtSabor" name="txtSabor" placeholder="Nome da pizza">
				</div>

				<div class="row mb-3">
					<div class="col">
						<label for="txtPrecop">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza P</small>
						<input type="text" class="form-control" id="txtPrecop" name="txtPrecop">
					</div>

					<div class="col">
						<label for="txtPrecom">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza M</small>
						<input type="text" class="form-control" id="txtPrecom" name="txtPrecom">
					</div>
				</div>          

				<div class="row mb-3">
					<div class="col">
						<label for="txtPrecog">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza G</small>
						<input type="text" class="form-control" id="txtPrecog" name="txtPrecog">
					</div>

					<div class="col">
						<label for="txtPrecogg">Preço</label>
						<small class="form-text text-muted d-inline-block"> da pizza GG</small>
						<input type="text" class="form-control" id="txtPrecogg" name="txtPrecogg">
					</div>
				</div>

				<div class="form-group">
					<label for="txtDescricao">Descrição</label>
					<textarea class="form-control" id="txtDescricao" name="txtDescricao" placeholder="Descrição da pizza"></textarea>
				</div>

				<div class="form-group" id="form-group_pizzas">
					<label for="upload" style="display: block;">Imagem da pizza</label>

					<img class="d-block img mb-4" id="img" style="width: 15%">

					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensPizzas">Selecionar imagem</button>
				</div>

				<button type="submit" class="btn btn-outline-success" style="width: 100%;">Adicionar</button>
			</form>

		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>

<script type="text/javascript">

	$('.img-pizzas').click(function(){
		var img_nome = $(this).attr('data-nome');
		$('.img').attr('src', '../img/produtos/pizzas/'+img_nome);
		$('#upload').val('pizzas/'+img_nome)
	});

</script>