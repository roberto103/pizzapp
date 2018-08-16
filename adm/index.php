<?php 

  require_once 'core/consultas.php';

 ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#bd2130">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Pizzapp</title>
    <link rel="shortcut icon" href="../img/favicon.ico" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/solid.css" integrity="sha384-Rw5qeepMFvJVEZdSo1nDQD5B6wX0m7c5Z/pLNvjkB14W6Yki1hKbSEQaX9ffUbWe" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/fontawesome.css" integrity="sha384-GVa9GOgVQgOk+TNYXu7S/InPTfSDTtBalSgkgqQ7sCik56N9ztlkoTr2f/T44oKV" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <style type="text/css">
      #img-prod{
        width: 35%;
        margin: 10px;
      }
    </style>

  </head>
  <body>
    <div class="container-fluid">
      <div class="row" >
        <div class="col-sm-12" style="background-color: #ff8a00 !important; height: 60px; position: absolute; z-index: 9999;">
        </div> 
      </div>
      <div class="row">
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

      <!-- início page -->
      <div class="row" style="margin-top: 20px;">
        <div class="col-4">
          <div class="list-group" id="list-tab" role="tablist">
            <a class="list-group-item list-group-item-action active" id="list-pedidos-list" data-toggle="list" href="#list-pedidos" role="tab" aria-controls="pedidos">Pedidos</a>
            <a class="list-group-item list-group-item-action" id="list-produtos-list" data-toggle="list" href="#list-produtos" role="tab" aria-controls="produtos">Produtos</a>
             <a class="list-group-item list-group-item-action" id="list-pizzas-list" data-toggle="list" href="#list-pizzas" role="tab" aria-controls="pizzas">Pizzas</a>
            <a class="list-group-item list-group-item-action" id="list-promocoes-list" data-toggle="list" href="#list-promocoes" role="tab" aria-controls="promocoes">Promoções</a>
            <a class="list-group-item list-group-item-action" id="list-usuarios-list" data-toggle="list" href="#list-usuarios" role="tab" aria-controls="usuarios">Usuários</a>
            <a class="list-group-item list-group-item-action" id="list-criticas-list" data-toggle="list" href="#list-criticas" role="tab" aria-controls="criticas">Críticas e sugestões</a>
          </div>
        </div>
        <div class="col-8">
          <div class="tab-content" id="nav-tabContent">
            <!-- PEDIDOS -->
            <div class="tab-pane fade show active" id="list-pedidos" role="tabpanel" aria-labelledby="list-pedidos-list">
              <h4 class="display-4" style="font-size: 2.5rem;">Pedidos</h4>
              <hr class="mb-3">
              <!-- Filtros dos pedidos -->
              <!-- <button type="button" class="btn btn-warning">Para ser atendidos</button>
              <button type="button" class="btn btn-warning">Prontos</button>
              <button type="button" class="btn btn-warning">Entregues</button>
              <hr class="mb-2"> -->

              <table class="table table-hover" id="myTable">
              <thead>
                <tr>
                  <th scope="col">Produto</th>
                  <th scope="col">Quantidade</th>
                  <th scope="col">Valor total</th>
                  <th scope="col">ID Pedido</th>
                  <th scope="col">Hora</th>
                  <th scope="col">Status</th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($registros as $pedido){ ?>
                  <tr>
                    <td scope="row" style="text-transform: capitalize;"><?php echo $pedido->produto_nome; ?></td>
                    <td><?php echo $pedido->quantidade; ?></td>
                    <td>R$ <?php echo decimalTela($pedido->valor_total); ?></td>
                    <td><?php echo $pedido->sessao; ?></td>
                    <td><?php echo $pedido->hora; ?></td>
                    <td>
                      <select class="custom-select" id="status_pedido">
                        <option selected disabled><?php echo $pedido->status; ?></option>
                        <option value="Pedido atendido">Atender</option>
                        <option value="Pedido pronto">Pedido Pronto</option>
                        <option value="Pedido retirado">Pedido Retirado</option>
                      </select>
                    </td>
                    <td>
                    	<button class="btn btn-outline-primary btn-status" data-sessao_pedido="<?php echo $pedido->sessao; ?>">OK</button>
                    </td>
                  </tr>
              <?php } ?>

              </tbody>
            </table>
            </div>
            <!-- PEDIDOS -->

            <!-- PRODUTOS -->
            <div class="tab-pane fade" id="list-produtos" role="tabpanel" aria-labelledby="list-produtos-list">
              <div id="novo-produto">
                <div id="prod_novo">
                  <h4 class="display-4" style="font-size: 2.5rem; display: inline;">Produtos</h4>
                    <a href="novo_produto.php">
                      <button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Novo produto</button>
                    </a>
                    <?php if (isset($_SESSION['msg'])) {
                      echo $_SESSION['msg'];
                      unset($_SESSION['msg']);
                    } ?>
                    <hr class="mb-3">
                  </div>

                  <?php foreach ($listarProdutos as $produto) { ?>
                  <div class="card" style="width: 17rem; display: inline-block; margin-bottom: 10px; margin-right: 10px;">
                    <center>
                      <img class="card-img-top" src="../img/produtos/uploads/<?php echo $produto->prod_img; ?>" id="img-prod">
                    </center>
                    <div class="card-body">
                      <h5 class="card-title" id="atualizaTitle_<?php echo $produto->prod_ID; ?>"><?php echo $produto->prod_nome; ?></h5>
                      <p class="card-text" id="atualizaDesc_<?php echo $produto->prod_ID; ?>"><?php echo $produto->prod_descricao; ?></p>
                      <p class="card-text" id="atualiza_<?php echo $produto->prod_ID; ?>">R$ <?php echo $produto->prod_preco; ?></p>
											<div class="btn-group" role="group">

												<a href="#" class="btn-editar btn btn-outline-primary" data-id="<?php echo $produto->prod_ID; ?>" data-nome="<?php echo $produto->prod_nome; ?>" data-descricao="<?php echo $produto->prod_descricao; ?>" data-preco="<?php echo $produto->prod_preco; ?>" data-upload="<?php echo $produto->prod_img; ?>" data-tipo="<?php echo $produto->prod_tipo; ?>">Editar</a>

												<a href="core/deletarProduto.php?prod_ID=<?php echo $produto->prod_ID; ?>" class="btn-deletar btn btn-outline-danger" data-confirm="deletar" data-id="<?php echo $produto->prod_ID; ?>" >Excluir</a>

											</div>
                    </div>
                  </div>
                <?php } ?>

              </div> <!-- /#novo-produto -->
            </div>
            <!-- /PRODUTOS -->

            <!-- PIZZAS -->
            <div class="tab-pane fade" id="list-pizzas" role="tabpanel" aria-labelledby="list-pizzas-list">
              <div id="nova-pizza">
                <div id="nova_pizza">
                  <h4 class="display-4" style="font-size: 2.5rem; display: inline;">Pizzas</h4>
                    <a href="nova_pizza.php">
                      <button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Nova pizza</button>
                    </a>
                    <?php if (isset($_SESSION['msg_pizza'])) {
                      echo $_SESSION['msg_pizza'];
                      unset($_SESSION['msg_pizza']);
                    } ?>
                    <hr class="mb-3">
                  </div>

                  <?php foreach ($pizza as $pizza) { ?>
                  <div class="card" style="width: 17rem; display: inline-block; margin-bottom: 10px; margin-right: 10px;">
                    <center>
                      <img class="card-img-top" src="../img/produtos/uploads/<?php echo $pizza->img_pizza; ?>" id="img-prod">
                    </center>
                    <div class="card-body">
                      <h5 class="card-title" id="atualizaTitle_<?php echo $pizza->id; ?>"><?php echo $pizza->sabor; ?></h5>
                      <p class="card-text" id="atualizaDesc_<?php echo $pizza->id; ?>"><?php echo $pizza->descricao; ?></p>
                      <p class="card-text" id="atualiza_<?php echo $pizza->id; ?>">R$ <?php echo $pizza->preco; ?></p>
                      <div class="btn-group" role="group">

                        <a href="#" class="btn-editar btn btn-outline-primary" data-target="" data-id="<?php echo $pizza->id; ?>" data-sabor="<?php echo $pizza->sabor; ?>" data-descricao="<?php echo $pizza->descricao; ?>" data-preco="<?php echo $pizza->preco; ?>" data-upload="<?php echo $pizza->img_pizza; ?>">Editar</a>

                        <a href="core/deletarPizza.php?id=<?php echo $pizza->id; ?>" class="btn-deletar btn btn-outline-danger" data-confirm="deletar" data-id="<?php echo $pizza->id; ?>">Excluir</a>

                      </div>
                    </div>
                  </div>
                <?php } ?>

              </div> <!-- /#nova-pizza -->
            </div>
            <!-- /PIZZAS -->

            <!-- PROMOÇÕES -->
            <div class="tab-pane fade" id="list-promocoes" role="tabpanel" aria-labelledby="list-promocoes-list">
              <div id="nova-promocao">
                <div id="promo_nova">
                  <h4 class="display-4" style="font-size: 2.5rem; display: inline;">Promoções</h4>
                    <a href="nova_promocao.php">
                      <button class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;">Nova promoção</button>
                    </a>
                    <?php if (isset($_SESSION['msg_promo'])) {
                      echo $_SESSION['msg_promo'];
                      unset($_SESSION['msg_promo']);
                    } ?>
                    <hr class="mb-3">
                  </div>

                  <?php foreach ($listarPromocao as $promocao) { ?>
                  <div class="card" style="width: 17rem; display: inline-block; margin-bottom: 10px; margin-right: 10px;">
                    <center>
                      <img id="img-prod" class="card-img-top" src="../img/produtos/uploads/<?php echo $promocao->img_promo; ?>">
                    </center>
                    <div class="card-body">
                      <h5 class="card-title" id="atualizaTitle_<?php echo $promocao->id; ?>"><?php echo $promocao->titulo; ?></h5>
                      <p class="card-text" id="atualizaDesc_<?php echo $promocao->id; ?>"><?php echo $promocao->desc_promo; ?></p>
                      <p class="card-text" id="atualiza_<?php echo $promocao->id; ?>">R$ <?php echo $promocao->preco_promo; ?></p>
                      <div class="btn-group" role="group">
                        <a href="#" class="btn btn-outline-primary" data-id="<?php echo $promo->id; ?>">Editar</a>

                        <a href="core/deletarPromocao.php?id=<?php echo $promocao->id; ?>" class="btn-deletar btn btn-outline-danger" data-confirm="deletar" data-id="<?php echo $promocao->id; ?>">Excluir</a>

                      </div>
                    </div>
                  </div>
                <?php } ?>

              </div> <!-- /#nova-promocao -->
            </div>
            <!-- /PROMOÇÕES -->

            <!-- USUÁRIOS -->
            <div class="tab-pane fade" id="list-usuarios" role="tabpanel" aria-labelledby="list-usuarios-list">
              <h4 class="display-4" style="font-size: 2.5rem; display: inline;">Usuários</h4>
              <a class="btn btn-outline-primary" style="margin-top: -20px; margin-left: 10px;" href="../cadastro.php">Novo usuário</a>
              <hr class="mb-3">
              
              <table class="table table-hover">
              <thead>
                <tr>
                  <th scope="col">ID</th>
                  <th scope="col">Nome</th>
                  <th scope="col">Email</th>
                  <th scope="col">Endereço</th>
                  <th scope="col">Ponto de Referência</th>
                </tr>
              </thead>
              <tbody>

              <?php foreach ($usuarios as $users){ ?>
                  <tr>
                    <td scope="row"><?php echo $users->ID; ?></td>
                    <td><?php echo $users->nome; ?></td>
                    <td><?php echo $users->email; ?></td>
                    <td><?php echo $users->endereco; ?></td>
                    <td><?php echo $users->ponto_de_referencia; ?></td>
                  </tr>
              <?php } ?>

              </tbody>
            </table>
            </div>
            <!-- /USUÁRIOS -->

            <!-- CRÍTICAS E SUGESTÕES -->
            <div class="tab-pane fade" id="list-criticas" role="tabpanel" aria-labelledby="list-criticas-list">
              <h4 class="display-4" style="font-size: 2.5rem;">Críticas e sugestões</h4>
              <hr class="mb-3">

              <?php foreach ($comentarios as $comentario) { ?>
              <div class="card mb-3">
                <h5 class="card-header" style="font-weight: 400;"><?php echo $comentario->nome; ?></h5>
                <div class="card-body">
                  <p class="card-text"><?php echo $comentario->comentario; ?></p>
                  <hr class="mb-3">
                  <span class="text-muted"><?php echo dataHoraTela($comentario->data); ?></span>
                </div>
              </div>
            <?php } ?>

            </div>
            <!-- /CRÍTICAS E SUGESTÕES -->

          </div>

          <!-- EDITAR PRODUTO -->
          <div id="modal-produtos" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="z-index: 9999 !important;">
            <div class="modal-dialog modal-lg">
              <div class="modal-content" style="padding: 15px;">

                <form method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="txtNomeProduto">Nome do Produto</label>
                    <input type="txt" class="form-control" id="txtNomeProduto">
                  </div>

                  <div class="form-group">
                    <label for="txtDescricaoProduto">Descrição do Produto</label>
                    <textarea class="form-control" id="txtDescricaoProduto"></textarea>
                  </div>

                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="txtPrecoProduto">Preço do Produto</label>
                      <input type="txt" class="form-control money" id="txtPrecoProduto" maxlength="6">
                    </div>

                    <div class="form-group col-md-6">
                      <label>Tipo de Produto</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="tiposProduto">Tipos</label>
                        </div>
                        <select class="custom-select" id="tiposProduto">
                          <option selected>Selecione um tipo</option>
                          <option value="Bebidas">Bebidas</option>
                          <option value="Porcoes">Porções</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="upload">Imagem do produto</label>
                    <input type="file" class="form-control" name="img" id="upload">
                    <img id="img" style="width: 15%">
                  </div>

                  <button type="submit" id="btn-salvar" class="btn btn-success">Salvar</button>
                </form>

              </div>
            </div>
          </div>
          <!-- /EDITAR PRODUTO -->

        </div>
      </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <script src="../js/jquery.mask.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">

      // Preview da imagem do produto
      $('#upload').change(function(){
        const file = $(this)[0].files[0];
        const fileReader = new FileReader();
        fileReader.onloadend = function() {
          $('#img').attr('src', fileReader.result);
        }
        fileReader.readAsDataURL(file);
      });

      $(document).ready(function(){

        // Confirmação para deletar produto
        $('a[data-confirm]').click(function(ev){
          var href = $(this).attr('href');
          if(!$('#confirm-delete').length){
            $('body').append('<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header bg-danger text-white">EXCLUIR PRODUTO<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></div><div class="modal-body">Tem certeza de que deseja excluir esse produto?</div><div class="modal-footer"><button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button><a class="btn btn-danger text-white" id="dataComfirmOK">Excluir</a></div></div></div></div>');
          }
          $('#dataComfirmOK').attr('href', href);
              $('#confirm-delete').modal({show: true});
          return false; 
        });
        // Confirmação para deletar produto

        // DataTable
        $('#myTable').DataTable({
          "language": {
            "lengthMenu": "Mostrando _MENU_ registros por página",
            "zeroRecords": "Nada encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "Nenhum registro disponível",
            "infoFiltered": "(filtrado de _MAX_ total de registros)"
          }
        });

        // Carregamento da página de novo produto
        $('#prod_novo a').click(function(e){
          e.preventDefault();
          var href = $(this).attr('href');
          $('#novo-produto').load(href+'#novo-produto');
        });

        // Carregamento da página de nova pizza
        $('#nova_pizza a').click(function(e){
          e.preventDefault();
          var href = $(this).attr('href');
          $('#nova-pizza').load(href+'#nova-pizza');
        });

        // Carregamento da página de nova promoção
        $('#promo_nova a').click(function(e){
          e.preventDefault();
          var href = $(this).attr('href');
          $('#nova-promocao').load(href+'#nova-promocao');
        });
        

        $(".btn-editar").click(function(){
          var id = $(this).attr('data-id');
          $("#btn-salvar").attr('data-id',id);
           $('#modal-produtos').modal();
        });

        // Editar pizza
        $(".btn-editar-pizza").click(function(){
          var id = $(this).attr('data-id');
          $("#btn-editar").attr('data-id',id);
           $('#modal-pizza').modal();
        });

        // Altera status do pedido
        $('.btn-status').click(function(){

        	var sessao_pedido = $(this).attr('data-sessao_pedido');
        	var status_pedido = $('#status_pedido').val();

        	$.ajax({
        		url: 'core/status_pedido.php',
        		type: 'post',
        		data: {
        			status_pedido: status_pedido,
        			sessao: sessao_pedido
        		},
	        	success:function(data){
	        		if (data == 1) {
	        			alert('Status do pedido alterado.');
	        		}else{
						alert('O status do pedido não pôde ser alterado.');
	        		}
	        	}
        	});
        });
        // 

        $("#btn-salvar").click(function(){

          $('.modal').modal('hide');

          var id = $(this).attr('data-id');
          var nome = $("#txtNomeProduto").val();
          var descricao = $("#txtDescricaoProduto").val();
          var preco = $("#txtPrecoProduto").val();
          var img = $("#upload").val();
          var tipo = $("#tiposProduto").val();

          $.ajax({
            url: 'editarProduto.php',
            type : 'post',
            data : {
                prod: id,
                prod_nome: nome,
                prod_descricao: descricao,
                prod_preco: preco,
                prod_img: img,
                prod_tipo: tipo
            },
            success : function(data){
               if (data == 1) {
                $("#atualizaImg_"+id).html(img);
                $("#atualizaTitle_"+id).html(nome);
                $("#atualizaDesc_"+id).html(descricao);
                $("#atualiza_"+id).html('R$ '+preco);
               } else {

               } 
            }//success       
          }); //ajax

          return false;
        }); //btn-salvar
      });

    </script>

  </body>
</html>