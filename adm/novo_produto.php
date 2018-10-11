<div class="container-fluid">
	<div class="row">
		<div class="col-sm" id="novo-produto" style="padding: 0;">

      <h4 class="display-4" style="font-size: 2.5rem; display: inline;">Produtos</h4>
      <a href="index.php">
        <button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Todos os produtos</button>
      </a>
      <hr class="mb-3">
      
		  <!-- novo produto -->

      <form method="POST" action="salvar_novo_produto.php" enctype="multipart/form-data" style="padding-bottom: 20px;">

        <div class="form-group">
          <label>Tipo de Produto</label>
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <label class="input-group-text" for="tiposProduto">Tipos</label>
            </div>
            <select class="custom-select" name="tipo_prod" id="tiposProduto">
              <option selected>Selecione um tipo</option>
              <option value="Bebidas">Bebidas</option>
              <option value="Porcoes">Porções</option>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="txtNome">Nome</label>
          <input type="text" class="form-control" id="txtNome" name="txtNome" placeholder="Nome do produto">
        </div>

        <div class="form-group">
          <label for="txtDescricao">Descrição</label>
          <textarea class="form-control" id="txtDescricao" name="txtDescricao" placeholder="Descrição do produto"></textarea>
        </div>

        <div class="form-group">
          <label for="txtPreco">Preço</label>
          <input type="text" class="form-control money" id="txtPreco" name="txtPreco" placeholder="Preço do produto">
        </div>

        <div class="form-group" id="form-group_bebidas" style="display: none;">
          <label for="upload" style="display: block;">Imagem da bebida</label>

          <img id="img" style="width: 15%" class="d-block img">
          <br>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensBedidas">Selecionar imagem</button>

        </div>

        <div class="form-group" id="form-group_porcoes" style="display: none;">
          <label for="upload" style="display: block;">Imagem da porção</label>

          <img class="d-block img" id="img" style="width: 15%">
          <br>

          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensPorcoes">Selecionar imagem</button>

        </div>

        <input type="hidden" class="form-control" name="img" id="upload">

        <button type="submit" class="btn btn-outline-success" style="width: 100%;">Adicionar</button>
      </form>

		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.mask.js"></script>
<script type="text/javascript" src="js/funcoesadm.js"></script>