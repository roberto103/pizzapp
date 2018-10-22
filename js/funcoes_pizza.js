$(document).ready(function () {


	function formatReal( int )
{
        var tmp = int+'';
        tmp = tmp.replace(/([0-9]{2})$/g, ",$1");
        if( tmp.length > 6 )
                tmp = tmp.replace(/([0-9]{3}),([0-9]{2}$)/g, ".$1,$2");

        return tmp;
}
	

			var preco = 0;
			var sabor;
			var sabor2;
			var preco2 = 0;
			var imagem;
			var imagem2;
			var qtdsabores;



		$('.escolha-sabor').click(function(){


   	    	preco = $(this).attr('data-preco');
	    	sabor = $(this).attr('data-sabor');
	    	imagem = $(this).attr('data-imagem');

				$('#saborpizza').val(sabor);
				$('#valorfinal').val(preco);

				$('#preco').html(formatReal(parseInt(preco)));
				$('#sabor1').html(sabor);
				$('#sabor2').remove();
				$('#barra_sabor').remove();

				$('#parte1').attr('src',imagem);
				$('#forma1').attr('src',imagem);

				$('#pizzaInfo').attr('data-preco',preco);
				$('#pizzaInfo').attr('data-imagem',imagem);
				$('#pizzaInfo').attr('data-sabor',sabor);

				if (qtdsabores == 2) {
					if (preco>preco2) {
						$('#valorfinal').val(preco);
						$('#preco').html(formatReal(parseInt(preco)));
					}else{
						$('#valorfinal').val(preco2);
						$('#preco').html(formatReal(parseInt(preco)));
					}
				}


		});

		$('.escolha-sabor2').click(function(){

			preco2 = $(this).attr('data-preco2');
	    	sabor2 = $(this).attr('data-sabor2');
	    	imagem2 = $(this).attr('data-imagem2');

				$('#preco').html(preco2);
				$('#sabor1').html(sabor1);

				$('#saborpizza2').val(sabor2);

				$('#parte2').attr('src',imagem2);

				$('#pizzaInfo').attr('data-preco2',preco2);
				$('#pizzaInfo').attr('data-imagem2',imagem2);
				$('#pizzaInfo').attr('data-sabor2',sabor2);

				if (preco>preco2) {
					$('#valorfinal').val(preco);
					$('#preco').html(formatReal(parseInt(preco)));
				}else{
					$('#valorfinal').val(preco2);
					$('#preco').html(formatReal(parseInt(preco)));
				}

		});



	// Tamanho da pizza
	$('#tamanhoPizza').click(function(){
		if ($('#tamanhoPizza').val() != '4' && $('#tamanhoPizza').val() != '0') {
			$('#saborPizza').css('visibility', 'visible'); // Deixa o select de sabor visivel caso não seja uma pizza pequena
			

		}else if($('#tamanhoPizza').val() == '4'){
			$('#saborPizza').css('visibility', 'hidden'); // Deixa o select de sabor invisivel caso seja uma pizza pequena
			$('#saboresPizza').val(1);

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
			$('#img_forma2').css('display','none');
			qtdsabores = 1;
		}
		else if ($('#saboresPizza').val() == '2') {
			qtdsabores = 2;
			$('#img_forma2').css('display','');
			$('#forma1').css('display','none');
			$('.img-fluid').css('display','none'); // Esconde a forma de 2 sabores
		}
		else{
				$('#forma1').css('display','');
				$('#img_forma2').css('display','none');
		}
	});

});