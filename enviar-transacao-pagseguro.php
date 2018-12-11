<?php
	include('conectar.php');
	@$cod_cliente=$_POST['cod_cliente'];
	@$nome=$_POST['nome'];
	@$cpf=$_POST['cpf'];
	@$nome=$_POST['nome'];
	@$forma_pagamento=$_POST['forma_pagamento'];
	@$cod_quarto=$_POST['cod_quarto'];
	@$tipo_de_quarto=$_POST['tipo_de_quarto'];
	@$data_entrada=$_POST['data_entrada'];
	@$data_saida=$_POST['data_saida'];
	@$valor_unitario=$_POST['valor_unitario'];
	@$valor_total=$_POST['valor_total'];
	echo "Você está sendo redirecionado para o site do PagSeguro...";
	@$salva_audit=mysqli_query($link, "INSERT INTO audit (cod_cliente, cod_quarto, tipo_de_quarto, data_entrada, data_saida, valor_total) VALUES ('$cod_cliente', '$cod_quarto', '$tipo_de_quarto', '$data_entrada', '$data_saida', '$valor_total')");
		require 'PagSeguroLibrary/PagSeguroLibrary.php';
		$paymentRequest = new PagSeguroPaymentRequest();  
		$paymentRequest->addItem('0001', 'Reserva', 1, @$valor_total); 
		$paymentRequest->setSender(  
		  'Nome do Fulano',  
		  'c33627255865565607371@sandbox.pagseguro.com.br',  
		  '11',  
		  '56273440',  
		  '156.009.442-76'  
		);  
		$paymentRequest->setCurrency("BRL");
		try {  

		  $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
		  $checkoutUrl = $paymentRequest->register($credentials);
		  echo '<script>window.location="'.$checkoutUrl.'"</script>';
		  
		} catch (PagSeguroServiceException $e) {  
		    die($e->getMessage());  
		} 
	// }
?>