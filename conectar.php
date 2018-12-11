<?php
	$servidor = 'localhost';
	$banco = 'hotelaria';
	$usuario = 'root';
	$senha = '';
	$link = mysqli_connect($servidor, $usuario, $senha, $banco);
	if(!$link)
	{
    	echo "erro ao conectar ao banco de dados!";
    exit();
	}
	
?>