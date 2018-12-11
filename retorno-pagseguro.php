<?php
	include('header.php');
	@$id_audit=$_GET['id_audit'];
	@$id_pagseguro=$_GET['id_pagseguro'];
	@$buscar_audit=mysqli_query($link, "SELECT * from audit WHERE id_audit='$id_audit'");
	if(@$buscar_audit){
		@$audit = mysqli_fetch_array(@$buscar_audit);
		@$cod_cliente = $audit['cod_cliente'];
		@$cod_quarto = $audit['cod_quarto'];
		@$tipo_de_quarto = $audit['tipo_de_quarto'];
		@$data_entrada = $audit['data_entrada'];
		@$data_saida = $audit['data_saida'];
		@$valor_total = $audit['valor_total'];
		@$salva_reserva=mysqli_query($link, "INSERT INTO reservas (cod_cliente, valor_total) VALUES ('$cod_cliente', '$valor_total')");
		if(@$salva_reserva){
			@$pega_reserva=mysqli_query($link, "SELECT * from reservas order by cod_reserva desc limit 1");
			if(@$pega_reserva){
				@$reserva=mysqli_fetch_array(@$pega_reserva);
				@$cod_reserva=@$reserva['cod_reserva'];
				@$quartos_da_reserva=mysqli_query($link, "INSERT INTO quartos_da_reserva (cod_reserva, cod_quarto, id_tipo, data_entrada, data_saida) VALUES('$cod_reserva', '$cod_quarto', '$tipo_de_quarto', '$data_entrada', '$data_saida')");
				if(@$quartos_da_reserva){
					@$salva_transacao=mysqli_query($link, "INSERT INTO transacoes_bancarias (cod_pagseguro, cod_reserva, status) VALUES ('$id_pagseguro', '$cod_reserva', 'P')");
					if(@$salva_transacao){
						@$limpa_audit=mysqli_query($link, "TRUNCATE TABLE audit");
						if(@$limpa_audit){
							echo "Pagamento inserido em nossos sistemas com sucesso! Aguarde a liberação da financeira!";
						}else{
							echo "Erro ao limpar a tabela log";
						}
					}else{
						echo "Erro no insert nas transações bancárias";
					}
				}else{
					echo "Erro no insert na tabela quartos_da_reserva";
				}
			}else{
				echo "Erro no select que pega o cod reserva pra inserir no quartos_da_reserva";
			}
		}else{
			echo "Erro no insert nas reservas";
		}
	}else{
		echo "Erro na busca da transação no banco de dados!";
	}
?>
<?php
	include('footer.php');
?>