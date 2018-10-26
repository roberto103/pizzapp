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

		// Carregamento da página de editar pizza
		$('#editar_pizzas a').click(function(e){
			e.preventDefault();
			var href = $(this).attr('href');
			$('#nova-pizza').load(href+'#nova-pizza');
		});

		// Altera status do pedido

		$('.btn-mostrar_pedido').click(function(){
			$('#bt-salvar-atender').attr('data-sessao_pedido',$(this).attr('data-sessao'));

			$('#bt-salvar-pronto').attr('data-sessao_pedido',$(this).attr('data-sessao'));

			$('#bt-salvar-entrega').attr('data-sessao_pedido',$(this).attr('data-sessao'));
		});

		$('.btn-status').click(function(){

			var sessao_pedido = $(this).attr('data-sessao_pedido');
			var status_pedido = $(this).attr('status');

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
						$('#status_'+sessao_pedido).html(status_pedido);
					}else{
						alert('O status do pedido não pôde ser alterado.');
					}
				}
			});
		});
		// 
	});


	// MOSTRAR PEDIDOS
	$('#modal-mostrar_pedido').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget) // Button that triggered the modal
		var recipient_id = button.data('id') // Extract info from data-* attributes
		var recipient_preco = button.data('valor')
		var recipient_desc = button.data('desc')
		var recipient_hora = button.data('hora')
		var recipient_endereco = button.data('endereco')
		var recipient_referencia = button.data('referencia')
		var recipient_cliente_nome = button.data('cliente')
		var recipient_status = button.data('status')
		var recipient_sessao = button.data('sessao')
		// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
		// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
		var modal = $(this)
		modal.find('.modal-title').text('Pedido número: ' + recipient_id)

		modal.find('#descricao').html(recipient_desc)
		modal.find('#valor').html('R$ ' + recipient_preco)
		modal.find('#hora').html(recipient_hora + ' Hrs')
		modal.find('#endereco').html('Rua ' + recipient_endereco)
		modal.find('#referencia').html(recipient_referencia)
		modal.find('#nomeCliente').html(recipient_cliente_nome)

		if (recipient_status == 'Aguardando atendimento') {

			$('#atender').removeAttr('disabled')

		} else if (recipient_status == 'Pedido atendido') {

			$('#pronto').removeAttr('disabled')

		} else if (recipient_status == 'Pedido pronto') {
			
			$('#entrega').removeAttr('disabled')

		}

		// Atualizar status
		$("#bt-salvar").click(function(){

			var pedido_sess = $(recipient_sessao);
			var pedido_status = $(recipient_status);

			$.ajax({
				method: 'POST',
				url: 'pedidoStatus.php',
				data: {
					sessao: pedido_sess,
					status: pedido_status
				},
				success: function(data){
					if (data == 1) {
						M.toast({html: 'Status do pedido alterado para: '+pedido_status});
					} else {
						M.toast({html: 'Erro ao alterar status do pedido!', classes: 'red'});
					}
				} //Success
			})
		});
	})