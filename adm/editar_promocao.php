<?php 

  require_once 'core/Sessao.php';
  require_once 'core/conexao.php';
  require_once 'core/util.php';

  if (!Sessao::estaLogado()) {
    header('Location: login.php');
  }

  // Listar todas as promoção
  $promocao = $pdo->prepare('SELECT * FROM promocoes WHERE id = :id ORDER BY id ASC');
  $promocao->bindvalue(':id',$_GET['id']);
  $promocao->execute();

  $promocao = $promocao->fetch(PDO::FETCH_OBJ);

 ?>

<title>Editar Promoção</title>
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

      <h4 class="display-4" style="font-size: 2.5rem; display: inline;">Promoções</h4>
      <a href="index.php">
        <button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Todas as promoções</button>
      </a>
      <hr class="mb-4">
      
      <!-- nova promocao -->
      <form method="POST" action="salvar_editar_promocao.php" enctype="multipart/form-data" style="padding-bottom: 20px;">

        <input type="hidden" name="id" value="<?php echo $promocao->id; ?>">

        <div class="form-group">
          <label for="txtTitulo">Título</label>
          <input type="text" class="form-control" id="txtTitulo" name="txtTitulo" placeholder="Nome da promoção" value="<?php echo $promocao->titulo; ?>">
        </div>

        <div class="row mb-3">
          <div class="col">
            <label for="txtPreco">Preço</label>
            <input value="<?php echo $promocao->preco_promo; ?>" type="text" class="form-control money2" id="txtPreco" name="txtPreco" placeholder="Preço da promoção">
          </div>

          <div class="col">
            <label for="txtDuracao">Duração</label>
            <small class="form-text text-muted d-inline-block"> em dias</small>
            <input value="<?php echo $promocao->duracao_promo; ?>" type="text" class="form-control" id="txtDuracao" name="txtDuracao" placeholder="Quantos dias a promoção vai estar valendo?">
          </div>
        </div>

        <div class="form-group">
          <label for="txtDescricao">Descrição</label>
          <textarea class="form-control" id="txtDescricao" name="txtDescricao" placeholder="Descrição da promoção"><?php echo $promocao->desc_promo; ?></textarea>
        </div>

        <div class="form-group">
          <label for="upload" style="display: block;">Imagem da promoção</label>
          <img id="img_promo" style="width: 15%">
          <input type="file" class="form-control" name="img_promo" id="upload_pizza">
        </div>

        <input type="hidden" name="img_promo-salva" value="<?php echo $promocao->img_promo; ?>">

        <button type="submit" class="btn btn-outline-success" style="width: 100%;">Salvar</button>
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