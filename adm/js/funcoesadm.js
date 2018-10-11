$(document).ready(function () {
	
	if ($('#tiposProdutos').val() == 'Bebidas') {
		$('#form-group_bebidas').css('display','');
		$('#form-group_porcoes').css('display','none');
	}else{
		$('#form-group_bebidas').css('display','none');
		$('#form-group_porcoes').css('display','');
	}

});