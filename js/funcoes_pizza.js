$(document).ready(function () {
	
	var preco;
	var sabor;
	var sabor2;
	var preco2;

	$('.escolha-sabor').click(function(){

		 preco = $(this).attr('data-preco');
		 sabor = $(this).attr('data-sabor');
		 preco2 = $(this).attr('data-preco');
		 sabor2 = $(this).attr('data-sabor');

		if ($('#saborespizza').val() == '1') {

			

		}

	});

	// Tamanho da pizza
	$('#tamanhoPizza').click(function(){
		if ($('#tamanhoPizza').val() != '4' && $('#tamanhoPizza').val() != '0') {
			$('#saborPizza').css('visibility', 'visible'); // Deixa o select de sabor visivel caso não seja uma pizza pequena
			

		}else if($('#tamanhoPizza').val() == '4'){
			$('#saborPizza').css('visibility', 'hidden'); // Deixa o select de sabor invisivel caso seja uma pizza pequena
			$('#saborespizza').val(1);

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


	// Forma da pizza
	$('#saboresPizza').click(function(){
		if ($('#saboresPizza').val() == '0' || $('#saboresPizza').val() == '1') {
			$('.img-fluid').css('display','');
		}
		else if ($('#saboresPizza').val() == '2') {
			$('#img_forma2').css('display','');
			$('#forma1').css('display','none');
			$('.img-fluid').css('display', 'none'); // Esconde a forma de 2 sabores
		}
		else{
			$('#forma1').css('display','');
			$('#img_forma2').css('display','none');
		}
	});

});