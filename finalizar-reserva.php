<?php
	include("header.php");
	@$cod_cliente=$_POST['cod_cliente'];
	@$cod_quarto=$_POST['cod_quarto'];
	@$data_entrada=$_POST['data_entrada'];
	@$data_saida=$_POST['data_saida'];
	@$tipo_de_quarto=$_POST['tipo_de_quarto'];
	@$consulta = mysqli_query($link,"SELECT * FROM clientes WHERE cod_cliente='$cod_cliente'");
	@$dados = mysqli_fetch_array($consulta);
	@$nome = $dados['nome'];
	@$cpf = $dados['cpf'];
	@$forma_pagamento = $dados['forma_pagamento'];
	@$consulta_valor=mysqli_query($link, "SELECT * from tipo_de_reserva where id_tipo='$tipo_de_quarto'");
	@$valor=mysqli_fetch_array(@$consulta_valor);
	@$valor_unitario = $valor['valor_diaria'];
	@$consulta_dias=mysqli_query($link, "select datediff('$data_saida', '$data_entrada')as dif");
	@$dias=mysqli_fetch_array(@$consulta_dias);
	@$qtd_dias = $dias['dif'];
	@$valor_total = @$valor_unitario * @$qtd_dias;
?> 
<div class="row">
	<div class="col s12">
		<div class="card-panel">
			<h4 class="header2"><center>REVISE SEUS DADOS!</center></h4><br>
			<h6 class="header2"><center>Informações da Reserva</center></h6><br>
			<div class="row">
				<form action="enviar-transacao-pagseguro.php" method="post">
					<div class="row">
						<div class="row">
							<h6><center>Informações do Cliente</center></h6>
							<input id="cod_cliente" name="cod_cliente" disabled value="<?=@$cod_cliente?>" type="hidden">
							<div class="input-field col s3 offset-s2">
								<input id="nome"  name="nome" disabled value="<?=@$nome?>" type="text">
								<label>Nome</label>
							</div>
							<div class="input-field col s2">
								<input id="cpf" name="cpf" disabled value="<?=@$cpf?>" type="text">
								<label>CPF</label>
							</div>
							<div class="input-field col s2">
								<input id="forma_pagamento" disabled name="forma_pagamento" value="<?=@$forma_pagamento?>" type="text">
								<label>Forma de Pagamento</label>
							</div>
						</div>
						<div class="row">
							<h6><center>Informações do Quarto</center></h6>
							<input id="cod_quarto" name="cod_quarto" disabled value="<?=@$cod_quarto?>" type="hidden">
							<input id="tipo_de_quarto" name="tipo_de_quarto" disabled value="<?=@$tipo_de_quarto?>" type="hidden">
							<div class="input-field col s2 offset-s2">
								<input id="data_entrada" name="data_entrada" disabled value="<?=@$data_entrada?>" type="text">
								<label>Checkin</label>
							</div>
							<div class="input-field col s2">
								<input id="data_saida"  name="data_saida" disabled value="<?=@$data_saida?>" type="text">
								<label>Checkout</label>
							</div>
							<div class="input-field col s1">
								<input id="unitario" name="valor_unitario" disabled value="<?=@$valor_unitario?>" type="text">
								<label>Unitário</label>
							</div>
							<div class="input-field col s2">
								<input id="valor_total" name="valor_total" disabled value="<?=@$valor_total?>" type="text">
								<label>Total</label>
							</div>
						</div>
						<h4 class="header2"><center>Realizar Pagamento</center></h4>
						<div class="row" align="center">
							<input alt="Pague com PagSeguro" name="submit"  type="image"  
src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/120x53-pagar.gif"/>
						</div>
					</div>
				</form>  
			</div>
		</div>
	</div>
</div> 
<?php
	include("footer.php");  
?>  





