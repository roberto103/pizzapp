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

        <div class="form-group">
          <label for="txtPreco">Preço</label>
          <input type="text" class="form-control" id="txtPreco" name="txtPreco" placeholder="Preço da pizza">
        </div>

        <div class="form-group">
          <label for="txtDescricao">Descrição</label>
          <textarea class="form-control" id="txtDescricao" name="txtDescricao" placeholder="Descrição da pizza"></textarea>
        </div>

        <div class="form-group">
          <label for="upload" style="display: block;">Imagem da pizza</label>
          <img id="img_pizza" style="width: 15%">
          <input type="file" class="form-control" name="img_pizza" id="upload_pizza">
        </div>

        <button type="submit" class="btn btn-outline-success" style="width: 100%;">Adicionar</button>
      </form>

    </div>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>

<script type="text/javascript">
  $('#upload_pizza').change(function(){
    const file = $(this)[0].files[0];
    const fileReader = new FileReader();
    fileReader.onloadend = function() {
      $('#img_pizza').attr('src', fileReader.result);
    }
    fileReader.readAsDataURL(file);
  });
</script>