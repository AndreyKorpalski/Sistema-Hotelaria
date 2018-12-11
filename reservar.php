<?php
	include("header.php");
	$prosseguir=0;
	@$consulta_qtd_quartos=mysqli_query($link, "SELECT qtd from qtd_quartos");
	@$qtd_quartos=mysqli_fetch_array(@$consulta_qtd_quartos);
	@$qtd = @$qtd_quartos['qtd'];
	if(@$_GET['cod_cliente']){
		@$cod_cliente=@$_GET['cod_cliente'];
	}
	if(@$_POST["verifica-quarto"]){
		@$cod_cliente=$_POST['cod_cliente'];
		echo @$codigo_cliente;
		@$data_entrada=$_POST['data_entrada'];
		@$data_saida=$_POST['data_saida'];
		@$tipo_de_quarto=$_POST['tipo_de_quarto'];
		for($i=1;$i<=$qtd;$i++){
			@$consulta = mysqli_query($link, "SELECT 
				DATEDIFF('$data_entrada', data_entrada) as dif_ent_ent,
				DATEDIFF('$data_entrada', data_saida) as dif_ent_saida,
				DATEDIFF('$data_saida', data_entrada) as dif_saida_ent, 
				DATEDIFF('$data_saida', data_saida) as dif_saida_saida
				 from quartos_da_reserva 
				 join transacoes_bancarias on
				 quartos_da_reserva.cod_reserva = transacoes_bancarias.cod_reserva
				 where cod_quarto='$i'
				 and transacoes_bancarias.status<>'N'");
				@$erro=0;
			while(@$dados = mysqli_fetch_array(@$consulta)){
  				@$dif_ent_ent=@$dados['dif_ent_ent'];
  				@$dif_ent_saida=@$dados['dif_ent_saida'];
  				@$dif_saida_ent=@$dados['dif_saida_ent'];
  				@$dif_saida_saida=@$dados['dif_saida_saida'];
  				if(@$dif_ent_ent<1){
  					if(@$dif_saida_ent>1){
						$erro++;
					}	
  				}
				if(@$dif_saida_saida>1){
  					if(@$dif_ent_saida<1){
  						$erro++;	
  					}
  				}
  				if(@$dif_ent_ent>1){
  					if(@$dif_saida_saida<1){
						$erro++;
  					}
  				}
			}
  			if(@$erro==0){
  				@$cod_quarto=@$i;
  				break 1;
  			}
  		}
  		if(@$erro==0){
  			$prosseguir=1;
?> 			<h6 align="center" class="header2">Datas disponíveis!</h6>
<?php  		}else{
?>			<h6 align="center" class="header2">Nenum quarto disponível nestas datas... :/<br>Tente Novamente :D</h6>
<?php		@$tipo_de_quarto='';
  			@$data_entrada='';
  			@$data_saida='';
  		}
	}
?>
<link rel="stylesheet" href="css/redmond/jquery-ui-1.10.1.custom.css" />
<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>   
<script type="text/javascript" src="js/materialize.js"></script>
<script type="text/javascript" src="js/prism.js"></script>
<script type="text/javascript" src="js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/chartist-js/chartist.min.js"></script>   
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#data_entrada").datepicker({
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		dateFormat: 'yy/mm/dd',
		nextText: 'Próximo',
		prevText: 'Anterior'
	});
});
</script>
<script type="text/javascript">
$(document).ready(function(e) {
	$("#data_saida").datepicker({
		dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
		dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
		dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
		monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
		monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
		dateFormat: 'yy/mm/dd',
		nextText: 'Próximo',
		prevText: 'Anterior'
	});
});
</script>
</head>
</script>
<div id="basic-form">
	<div class="row">
		<div class="col s12">
			<div class="card-panel">
				<h4  align="center" class="header2">Informações de Hospedagem</h4>
				<div class="row">
					<form class="col s12" method="post" action="reservar.php">
						<input id="cod_cliente" name="cod_cliente" value="<?=@$cod_cliente?>" type="hidden">
						<div class="input-field col s2 offset-s3">
<?php						if(@$tipo_de_quarto==1){
?>								<input type="text" value="Solteiro"/>
<?php						}elseif(@$tipo_de_quarto==2){
?>								<input type="text" value="Casal"/>
<?php  						}else{
?>								<select id="tipo_de_quarto" name="tipo_de_quarto">
									<option value="" disabled selected>Tipo de quarto</option>
									<option value="1">Solteiro</option>
									<option value="2">Casal</option>
								</select>
<?php  						}
?>						</div>
						<div class="row">
							<div class="input-field col s2 -offset 2">
								<input type="text" id="data_entrada" name="data_entrada" placeholder="Checkin" value="<?=@$data_entrada?>"/>
							</div>
							<div class="input-field col s2">
								<input type="text" id="data_saida" name="data_saida" placeholder="Checkout" value="<?=@$data_saida?>"/>
							</div>
						</div>
<?php  					if(@$prosseguir==0){
	
?>							<div class="row" align="center">
							<div class="input-field col 2 s8">
								<input type="button" value="Voltar" class="btn black right" onclick="JavaScript: window.history.back();" style="margin-right: 28%;">
                                <input type="submit" value="Prosseguir" style="margin-right: -25%;" name="verifica-quarto" class="btn black right">
							</div>
							</div>
<?php 					}
?>					</form>
<?php 				if(@$prosseguir==1){
?>						<form method="post" action="finalizar-reserva.php" align="center">
							<div class="input-field col 1 s4">
								<input type="button" value="Voltar"  class="btn black right" onclick="JavaScript: window.history.back();">
							</div>
							<h6  align="center" style="margin-right: 34%;" class="header2">Confirmar dados?</h6>
							<input id="cod_cliente" name="cod_cliente" value="<?=@$cod_cliente?>" type="hidden">
							<input id="cod_quarto" name="cod_quarto" value="<?=@$cod_quarto?>" type="hidden">
							<input id="data_entrada" name="data_entrada" value="<?=@$data_entrada?>" type="hidden">
							<input id="data_saida" name="data_saida" value="<?=@$data_saida?>" type="hidden">
							<input id="tipo_de_quarto" name="tipo_de_quarto" value="<?=@$tipo_de_quarto?>" type="hidden">
							<input type="submit" value="Prosseguir" style="margin-right: 34%;" class="btn black">
						</form>
<?php				}?>
				</div>
			</div>
		</div> 
	</div>
</div>