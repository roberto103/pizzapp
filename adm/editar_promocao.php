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

		<div class="form-group" id="form-group_promocao">
		  <label for="upload" style="display: block;">Imagem da promoção</label>

		  <img class="d-block img mb-4" id="img" style="width: 15%">

		  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalImagensPromocoes">Selecionar imagem</button>
		</div>

		<input type="hidden" name="img_promo" id="upload" class="form-control">

		<button type="submit" class="btn btn-outline-success" style="width: 100%;">Adicionar</button>
	  </form>

	</div>
	<div class="col"></div>
  </div>
</div>

<!-- MODAL DAS IMAGENS PROMOÇÕES -->
<div class="modal fade bd-example-modal-lg" id="modalImagensPromocoes" tabindex="-1" role="dialog" aria-labelledby="modallabelEx" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
	<div class="modal-content">
	  <div class="modal-header">
		<h5 class="modal-title" id="modallabelEx">Banco de imagens</h5>
	  </div>

	  <div class="modal-body">

	  	<div class="imagens">
	  		<?php 
	  			$pasta = '../img/produtos/promocoes/';
	  			$arquivos = scandir($pasta);

	  			foreach ($arquivos as $arquivo) {
	  				if (($arquivo != '.') && ($arquivo != '..')) {
	  		 ?>
	  			<img data-dismiss="modal" src="<?php echo $pasta.$arquivo; ?>" class="img-fluid img-promocoes" data-nome="<?php echo $arquivo;?>">
	  		<?php }} ?>

	  	</div>
	  </div>
	</div>
  </div>
</div>
<!-- /MODAL DAS IMAGENS PROMOÇÕES-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<script type="text/javascript" src="../js/jquery.mask.js"></script>

<script type="text/javascript">

	$('.money2').mask("0.000,00", {reverse: true});

  	$('.img-promocoes').click(function(){
		var img_nome = $(this).attr('data-nome');
		$('.img').attr('src', '../img/produtos/promocoes/'+img_nome);
		$('#upload').val('promocoes/'+img_nome)
	});

</script>