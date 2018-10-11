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

	//modal da imagem

	$('.img-bebidas').click(function(){
		alert('produto selecionado');
		$('#modalImagensBedidas').modal('hide');
	});
});