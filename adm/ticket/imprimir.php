<?php

	require __DIR__ . '/ticket/autoload.php'; // Nota: se você renomeou a pasta para algo diferente de "ticket", altere o nome nesta linha
	use Mike42\Escpos\Printer;
	use Mike42\Escpos\EscposImage;
	use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

	/*
		Este exemplo imprime
		bilhete de venda de uma impressora térmica
	*/


	/*
	    Aqui, em vez de "POS" (que é o nome da minha impressora)
		escreva o nome da sua. Lembre-se que você deve compartilhá-lo
		do painel de controle
	*/
	$nombre_impresora = "POS"; 


	$connector = new WindowsPrintConnector($nombre_impresora);
	$printer = new Printer($connector);
	#envia um número de resposta para saber que ele estava conectado corretamente.
	echo 1;

	/*
		Nós vamos imprimir um logotipo
		opcional Lembre-se que isso
		não vai funcionar em todas
		impressoras

		Nota pequena: Recomenda-se que a imagem não seja
		transparente (mesmo se png você tem que remover o canal alfa)
		e ter uma baixa resolução. No meu caso
		a imagem que uso é de 250 x 250
	*/

	# Vamos alinhar a próxima coisa que imprimiremos no centro
	$printer->setJustification(Printer::JUSTIFY_CENTER);

	/*
		Vamos carregar e imprimir
		o logotipo
	*/
	try{
		$logo = EscposImage::load("logo.png", false);
		$printer->bitImage($logo);
	}catch(Exception $e){
		/* Nós não fazemos nada se houver um erro */
	}

	/*
		Agora vamos imprimir um cabeçalho
	*/
	$printer->text("\n"."Nome da empresa" . "\n");
	$printer->text("Endereço: ASASAS #464" . "\n");
	$printer->text("Tel: 454664544" . "\n");

	#A data e hora também
	date_default_timezone_set("America/Recife");
	$printer->text(date("Y-m-d H:i:s") . "\n");
	$printer->text("-----------------------------" . "\n");
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text("DESCRIÇÃO\n");
	$printer->text("-----------------------------"."\n");

	/*
		Agora vamos imprimir o
		produtos
	*/

	/* Alinhar para a esquerda para a quantidade e nome */
	$printer->setJustification(Printer::JUSTIFY_LEFT);
	$printer->text("Produto 1 \n");
	$printer->text( "2  uni.    10.00 20.00   \n");
	$printer->text("Produto 2 \n");
	$printer->text( "3  uni.    10.00 30.00   \n");
	$printer->text("Produto 3 \n");
	$printer->text( "5  uni.    10.00 50.00   \n");

	/*
		Nós terminamos a impressão
		os produtos, agora o total
	*/
	$printer->text("-----------------------------"."\n");
	$printer->setJustification(Printer::JUSTIFY_RIGHT);
	$printer->text("SUBTOTAL: $100.00\n");
	$printer->text("IVA: $16.00\n");
	$printer->text("TOTAL: $116.00\n");


	/*
		Nós também podemos colocar um rodapé
	*/
	$printer->setJustification(Printer::JUSTIFY_CENTER);
	$printer->text("Obrigado pela preferência\n");



	/* Nós alimentamos o papel 3 vezes */
	$printer->feed(3);

	/*
		Nós cortamos o papel. Se a nossa impressora
		não tem suporte para isso, não vai gerar erro
	*/
	$printer->cut();

	/*
		Nós enviamos um pulso através da impressora.
		Isso é útil quando a temos conectada
		por exemplo, para uma gaveta
	*/
	$printer->pulse();

	/*
		Para realmente imprimir, temos que "fechar"
		a conexão com a impressora. Lembre-se de incluir isso no final de todos os arquivos
	*/
	$printer->close();

?>