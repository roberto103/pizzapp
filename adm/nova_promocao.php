<div class="container-fluid">
	<div class="row">
		<div class="col-sm" id="novo-produto" style="padding: 0;">

			<h4 class="display-4" style="font-size: 2.5rem; display: inline;">Promoção</h4>
			<a href="index.php">
				<button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Todas as promoções</button>
			</a>
			<hr class="mb-3">
			
			<!-- novo produto -->

			<form method="POST" action="salvar_nova_promocao.php" enctype="multipart/form-data" style="padding-bottom: 20px;">

				<div class="form-group">
					<label for="txtTitulo">Titulo</label>
					<input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Promoção">
				</div>

				<div class="form-group">
					<label for="txtDesc">Descrição</label>
					<textarea class="form-control" id="txtDesc" name="txtDesc" placeholder="Descrição da promoção"></textarea>
				</div>

				<div class="row mb-3">
					<div class="col">
						<label for="txtPreco">Preço</label>
						<input type="text" class="form-control" id="txtPreco" name="txtPreco" placeholder="Preço da promoção">
					</div>

					<div class="col">
						<label for="txtDuracao">Duração</label>
						<input type="text" class="form-control" id="txtDuracao" name="txtDuracao" placeholder="Duração da promoção em dias">
					</div>
				</div>

				<div class="form-group" id="form-group_porcoes">
					<label for="upload" style="display: block;">Imagem da promoção</label>

					<img class="d-block img mb-4" id="img" style="width: 15%">

					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensPromocao">Selecionar imagem</button>
				</div>

				<button type="submit" class="btn btn-outline-success" style="width: 100%;">Adicionar</button>
			</form>

		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>

<script type="text/javascript">

	$('.img-promocao').click(function(){
		var img_nome = $(this).attr('data-nome');
		$('.img').attr('src', '../img/produtos/promocoes/'+img_nome);
		$('#upload').val('promocoes/'+img_nome)
	});

</script>