<?php
	include ("conectar.php");
	@$cod_cliente = $_POST['cod_cliente'];
	@$nome = $_POST['nome'];
	@$cpf = $_POST['cpf'];		
	@$status_cliente = $_POST['status_cliente'];
	@$sexo = $_POST['sexo'];
	@$email = $_POST['email'];
	@$telefone = $_POST['telefone'];
	@$endereco = $_POST['endereco'];
	@$forma_pagamento = $_POST['forma_pagamento'];
	@$insert = "UPDATE clientes SET nome='$nome',cpf='$cpf',sexo='$sexo',email='$email',telefone='$telefone',endereco='$endereco', forma_pagamento='$forma_pagamento', ultima_atualizacao=now()
	 where cod_cliente='$cod_cliente'";
	if ($link->query($insert) === TRUE){
		header("Location: index.php");
	}else{
		include ("header.php");
		echo "Não foi possivel ALTERAR os dados, devido ao erro: " . $link->error;
		include ("footer.php");
	}
?>
