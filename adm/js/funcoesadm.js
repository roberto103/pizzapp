$(document).ready(function () {

	
	$('#tiposProduto').click(function(){
	 if ($('#tiposProduto').val() == 'Bebidas') {
		$('#form-group_bebidas').css('display','');
		$('#form-group_porcoes').css('display','none');
	}else{
			$('#form-group_bebidas').css('display','none');
			$('#form-group_porcoes').css('display','');	
	}

	});

	$('.img-bebidas').click(function(){
		var img_nome = $(this).attr('data-nome');
		$('.img').attr('src', '../img/produtos/bebidas/'+img_nome);
		$('#upload').val('bebidas/'+img_nome)
	});

	$('.img-porcoes').click(function(){
		var img_nome = $(this).attr('data-nome');
		$('.img').attr('src', '../img/produtos/porcoes/'+img_nome);
		$('#upload').val('porcoes/'+img_nome)
	});

});