<?php

/* SEGURANÇA *************************************************************************/
/**
* Criptografa dados sensíveis, adicionando um salt para 
* dar mais segurança e salvar os dados em uma tabela
* possibilitando a descriptografia
*/
function criptografa($pString,$pSalt) {
	return openssl_encrypt(trim($pString),"AES-128-ECB",$pSalt);
}

/**
* Descriptografa dados sensíveis utilizando o salt usado na criptografia
*/
function descriptografa($pString,$pSalt) {
	return openssl_decrypt(trim($pString),"AES-128-ECB",$pSalt);
}

/**
* Gera hash de string junto com um salt onde não é possível descriptografar
*/
function geraHash($pString,$pSalt) {
	return hash('sha512', $pSalt.trim($pString));
}


/* DATAS *****************************************************************************/
/**
* Desinverte datas vindas do MySql para o formato dd/mm/aaaa para exibir em tela
*/
function dataTela($pData) {
	$data_desinvertida = implode("/", array_reverse(explode("-", substr(trim($pData),0,10))));	
	return $data_desinvertida;
}

/**
* Inverte datas para salvar em um BD MySQL no formato aaaa-mm-dd
*/
function dataBanco($pData) {
	$data_invertida = implode("-", array_reverse(explode("/", substr(trim($pData),0,10))));	
	return $data_invertida;
}

/**
* Desinverte data e hora vindas do MySql para o formato dd/mm/aaaa 00:00:00 
* para exibir em tela
*/
function dataHoraTela($pDataHora) {
	$data_desinvertida = implode("/", array_reverse(explode("-", substr(trim($pDataHora),0,10))));	
	$hora = substr(trim($pDataHora),11,8);
	return $data_desinvertida.' '.$hora;
}

/**
* Inverte data e hora para salvar em um BD MySQL no formato aaaa-mm-dd 00:00:00
*/
function dataHoraBanco($pDataHora) {
	$data_invertida = implode("-", array_reverse(explode("/", substr(trim($pDataHora),0,10))));	
	$hora = substr(trim($pDataHora),11,8);
	return $data_invertida.' '.$hora;
}

/* NUMEROS *****************************************************************************/
/**
* Converte números reais vindos do MySQL para o formato 0.000,00
*/
function decimalTela($pDecimal) {
	$pDecimal = $pDecimal/100;
	return number_format($pDecimal,2,',','.');
}

/**
* Converte números reais para salvar no MySQL no formato 0000.00
*/
function decimalBanco($pDecimal) {
	$pDecimal = str_replace(',','', $pDecimal);
	$pDecimal = str_replace('.','', $pDecimal);
	return $pDecimal;
}

/* STRINGS *****************************************************************************/
/**
* Retira acentos de strings
*/
function retiraAcentos($pString) {
	return preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml|caron);~i', '$1', htmlentities($pString, ENT_QUOTES, 'UTF-8'));
}

/**
* Limita um text para um certa quantidade de caracteres que será 
* impresso em tela permitindo ou não quebrar uma palavra no meio
*/
function limitaCaracteres($texto, $limite, $quebra = true) {
	$tamanho = strlen($texto);
	 
	if ($tamanho <= $limite) {
		$novo_texto = $texto;
	} else {
		if ($quebra == true) {
			$novo_texto = trim(substr($texto, 0, $limite)).' ...';
		
		} else {
			$ultimo_espaco = strrpos(substr($texto, 0, $limite), ' ');
			$novo_texto = trim(substr($texto, 0, $ultimo_espaco)).' ...';
		}
	}

	return $novo_texto;
}

/**
* Imprime texto na tela de forma segura, previnindo ataques xss
*/
function echo_($pString) {
	echo htmlentities($pString, ENT_QUOTES, 'UTF-8');
}