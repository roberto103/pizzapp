$(document).ready(function () {
	
	var preco1;
	var preco2;

	var sabor = $(this).attr('data-sabor');

	$('.escolha-sabor img').click(function() {
		$('#forma1').attr('src','img/produtos/uploads/'+$(this).attr('data-imagem'));
	});

	$('#parte1').click(function(){
		$('#modalSabores').attr('data-parteClicada','parte1');
	});
	$('#parte2').click(function(){	
		$('#modalSabores').attr('data-parteClicada','parte2');	
	});

	$('.escolha-sabor img').click(function(){
		//alert($(this).attr('data-preco'));

		if ($('#modalSabores').attr('data-parteClicada') == 'parte1') {
			var sabor = $(this).attr('data-sabor')
			$('#parte1').attr('src','img/produtos/uploads/'+$(this).attr('data-imagem'));
			preco1 = $(this).attr('data-preco');
			sabor = $(this).attr('data-sabor');

			$('#sabor1').html(sabor);

			if (preco1>preco2) {
			 $('#preco').html(preco1);
			 $('#valorfinal').val(preco1);
			 $('#saborpizza').val(sabor);
			 $('#finalizar').attr("data-precototal",preco1);
			}else{
				$('#preco').html(preco2);
				$('#valorfinal').val(preco2);
				$('#saborpizza').val(sabor);
				$('#finalizar').attr("data-precototal",preco2);
			}
		} else {

			$('#parte2').attr('src','img/produtos/uploads/'+$(this).attr('data-imagem'));
			preco2 = $(this).attr('data-preco');
			sabor = $(this).attr('data-sabor');

			$('#barra_sabor').html("/");
			$('#sabor2').html(sabor);

			if (preco1>preco2) {
			 $('#preco').html(preco1);
			 $('#valorfinal').val(preco1);
			 $('#saborpizza').val(sabor);
			 $('#finalizar').attr("data-precototal",preco1);
			}else{
				$('#preco').html(preco2);
				$('#valorfinal').val(preco2);
				$('#saborpizza').val(sabor);
				$('#finalizar').attr("data-precototal",preco2);

			}
		}

		

	});

$('#tamanhoPizza').click(function(){
	if ($('#tamanhoPizza').val() != '4' && $('#tamanhoPizza').val() != '0') {
		$('#saborPizza').css('visibility', 'visible'); // Deixa o select de sabor visivel caso não seja uma pizza pequena
		

	}else if($('#tamanhoPizza').val() == '4'){
		$('#saborPizza').css('visibility', 'hidden'); // Deixa o select de sabor invisivel caso seja uma pizza pequena


		$('.img-fluid').css('display', 'inline'); // Mostra a forma de 1 sabor
		$('#pizzaInfo map').css('display', 'none'); // Esconde a forma de 2 sabores
		$('#pizzaInfo #img_forma2').css('display', 'none'); // Esconde a forma de 2 sabores
		
	}else{
		$('#saborPizza').css('visibility', 'hidden'); // Deixa o select de sabor invisivel caso seja uma pizza pequena 
	}

	if ($('#tamanhoPizza').val() == '1' && $('#tamanhoPizza').val() != '0') {
		$('.pizzap').css('display','none');
		$('.pizzam').css('display','none');
		$('.pizzag').css('display','none');
		$('.pizzagg').css('display','');
	}else{
		if ($('#tamanhoPizza').val() == '2' && $('#tamanhoPizza').val() != '0') {
			$('.pizzap').css('display','none');
			$('.pizzam').css('display','none');
			$('.pizzag').css('display','');
			$('.pizzagg').css('display','none');
		}else{
			if ($('#tamanhoPizza').val() == '3' && $('#tamanhoPizza').val() != '0') {
				$('.pizzap').css('display','none');
				$('.pizzam').css('display','');
				$('.pizzag').css('display','none');
				$('.pizzagg').css('display','none');
				preco = $(this).attr('data-preco');
				$('#preco').html(preco);
			}else{
				if ($('#tamanhoPizza').val() == '4' && $('#tamanhoPizza').val() != '0') {
					$('.pizzap').css('display','');
					$('.pizzam').css('display','none');
					$('.pizzag').css('display','none');
					$('.pizzagg').css('display','none');
				}
			}
		}
	}


});

$('#saboresPizza').click(function(){
	if ($('#saboresPizza').val() == '0') {
		$('.img-fluid').css('display','');
	}else{
		if ($('#saboresPizza').val() == '1' || $('#saboresPizza').val() == '0') {
			$('#img_forma2').css('display','');
			$('#forma1').css('display','none');
			$('.img-fluid').css('display', 'none'); // Esconde a forma de 2 sabores
		}else{
			$('#forma1').css('display','');
			$('#img_forma2').css('display','none');

		}
	}
});

});