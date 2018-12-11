<?php
	include("header.php");
?>
<div id="basic-form">
	<div class="row">
		<div class="col s12">
			<div class="card-panel">
				<h4 class="header2"><center>Informações do usuário</center></h4>
				<div class="row">
					<div class="row">
<?php          			if(@$_GET['cod_cliente']){
							@$edita = mysqli_query($link,"SELECT * FROM clientes WHERE cod_cliente=".$_GET['cod_cliente']);
							@$dados = mysqli_fetch_array($edita);
							@$cod_cliente = $dados['cod_cliente'];          
							@$nome = $dados['nome'];
							@$cpf = $dados['cpf'];
							@$status_cliente = $dados['status_cliente'];
							@$sexo = $dados['sexo'];
							@$email = $dados['email'];
							@$telefone = $dados['telefone'];
							@$endereco = $dados['endereco'];
							@$forma_pagamento = $dados['forma_pagamento'];
							@$ultima_edicao = $dados['ultima_edicao'];    
						}
?>						<form action="salva-edicao.php" method="post">
							<div class="row">
								<input id="cod_cliente" value="<?=@$cod_cliente?>" name="cod_cliente" type="hidden">
								<div class="input-field col s5 offset-s2">
									<input id="nome" name="nome" value="<?=@$nome?>" type="text">
									<label>Nome</label>
								</div>
								<div class="input-field col s3">
									<input id="email"  name="email" value="<?=@$email?>" type="email">
									<label>Email</label>
								</div>
							</div>
							<div class="row">
								<div class="input-field col s2 offset-s2">
									<input id="cpf" name="cpf" value="<?=@$cpf?>" type="text">
									<label>CPF</label>
								</div>
								<div class="input-field col s2">
									<input id="telefone"  name="telefone" value="<?=@$telefone?>" type="text">
									<label>Telefone</label>
								</div>
								<div class="input-field col s2">
									<select id="forma_pagamento" name="forma_pagamento" type="text" required="">
										<option value=""></option>
										<option value="Dinheiro">Dinheiro</option>
 						 				<option value="Debito">Débito</option>
  										<option value="Credito">Crédito</option>
  										<option value="PayPal">Cheque - PayPal</option>
  									</select>
									<label>Forma de Pagamento</label>
								</div>
								<div class="input-field col s2">
									<select id="sexo"  name="sexo" type="text" required="">
										<option value=""></option>
										<option value="Masculino">Masculino</option>
 						 				<option value="Feminino">Feminino</option>
  										<option value="Outro">Outro</option>
  									</select>
									<label>Sexo</label>
								</div>
							</div>
							<div class="row">
								<div class="card col s8 offset-s2">
									<div class="card-content">
										<span class="card-title black-text">Endereço</span>
											<input type="text" id="endereco" name="endereco" value="<?=@$endereco?>">
									</div>
								</div>
							</div>
							<div class="row">
							<div class="input-field col s2 offset-s2">
									<input type="button" value="Cancelar" class="btn black right" onClick="JavaScript: window.history.back();">
								</div>
								<div class="input-field col s2 offset-s2">
									<input type="submit" class="btn black right">
								</div>
							</div>
						</form>
					</div>
				</div> 
			</div>
		</div>
	</div>
</div>
<?php
    include("footer.php");  
?>  





