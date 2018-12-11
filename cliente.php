<?php
	include("header.php");
?>

<div id="basic-form">
	<div class="row">
		<div class="col s12">
			<div class="card-panel">
				<h4 class="header2"><center>Informações do usuário</center></h4>
				<div class="row">
					<form class="col s12">
						<div class="row">
<?php						if(@$_GET['cod_cliente']){
								@$cod_cliente=$_GET['cod_cliente'];
								@$consulta = mysqli_query($link,"SELECT * FROM clientes WHERE cod_cliente=".$_GET['cod_cliente']);
								@$dados = mysqli_fetch_array($consulta);
								@$cod_cliente = $dados['cod_cliente'];          
								@$nome = $dados['nome'];
								@$cpf = $dados['cpf'];
								@$status_cliente = $dados['status_cliente'];
								@$sexo = $dados['sexo'];
								@$email = $dados['email'];
								@$telefone = $dados['telefone'];
								@$endereco = $dados['endereco'];
								@$forma_pagamento = $dados['forma_pagamento'];
								@$ultima_atualizacao = date('d/m/Y', strtotime($dados['ultima_atualizacao']));
								@$consulta_data = mysqli_query($link, "SELECT DATEDIFF(NOW(),(SELECT ultima_atualizacao from clientes where cod_cliente=2)) as dif from clientes WHERE cod_cliente=".$_GET['cod_cliente']);
								@$data = mysqli_fetch_array($consulta_data);
								@$diferenca = $data['dif'];
							}
?>							<div class="row">
								<div class="input-field col s3 offset-s2">
									<input id="nome" disabled value="<?=@$nome?>" type="text">
									<label>Nome</label>
								</div>
								<div class="input-field col s2">
									<input id="cpf" disabled value="<?=@$cpf?>" type="text">
									<label>CPF</label>
								</div>
								<div class="input-field col s3">
									<input id="email" disabled value="<?=@$email?>" type="email">
									<label>Email</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s2 offset-s2">
									<input id="sexo" disabled value="<?=@$sexo?>" type="text">
									<label>Sexo</label>
								</div>
								<div class="input-field col s2">
									<input id="telefone" disabled value="<?=@$telefone?>" type="text">
									<label>Telefone</label>
								</div>
								<div class="input-field col s2">
									<input id="forma_pagamento" disabled value="<?=@$forma_pagamento?>" type="text">
									<label>Forma de Pagamento</label>
								</div>
								<div class="input-field col s2">
									<input id="edicao" disabled value="<?=@$ultima_atualizacao?>" type="text">
									<label>Última atualização</label>
								</div>
							</div>
							<div class="row">
								<div class="card col s8 offset-s2">
									<div class="card-content">
										<span class="card-title black-text">Endereço</span>
											<p><?=@$endereco?></p>
									</div>
								</div>
							</div>
							<h4 class="header2"><center>Situação Financeira</center></h4>
							<div class="row">
								<div class="input-field col s12" align="center">
<?php								if($status_cliente =="A"){
										@$msg="Status aprovado! ";
?>										<i class="medium material-icons green">payment</i>
<?php								}else if($status_cliente=="N"){
										@$msg="Status desaprovado! "; 
										@$erro=1;
?>										<i class="medium material-icons red">payment</i>
<?php  								}
									if($diferenca<=60){
										@$msg= @$msg . "Cliente atualizado!";
?>										<i class="medium material-icons green">system_update_alt</i>
<?php								}else {
										@$msg= @$msg . "Cliente desatualizado!";
										@$erro=1;
?>										<i class="medium material-icons red">system_update_alt</i>
<?php								}
?>								</div>
								<div class="input-field col s12" align="center">
<?php 								echo @$msg;?>
								</div>
							</div>
							<div class="row">
							<div class="input-field col s1 offset-s2">
									<input type="button" value="Cancelar" class="btn black right" onClick="JavaScript: window.history.back();">
								</div>
								<div class="input-field col s2 offset-s1" style="margin-right:5%">
									<a href="editar.php?cod_cliente=<?=$dados['cod_cliente']?>" class="btn black right">Editar</a>
								</div>
<?php  							if(@$erro==1){
?>									<div class="input-field col s2 offset-s1">
										<a href="#" class="btn black right disabled">Prosseguir</a>
									</div>
<?php							}else{
?>									<div class="input-field col s2 offset-s1">
										<a href="reservar.php?cod_cliente=<?=$dados['cod_cliente']?>" class="btn black right">Prosseguir</a>
									</div>
<?php							}
?>							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div> 
<?php
    include("footer.php");  
?>  





