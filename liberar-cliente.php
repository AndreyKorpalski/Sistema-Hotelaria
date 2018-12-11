<?php
	include('header.php');
	@$busca_transacoes=mysqli_query($link, "SELECT transacoes_bancarias.cod_transacao, transacoes_bancarias.cod_pagseguro, clientes.nome, 
									clientes.cpf, transacoes_bancarias.status FROM transacoes_bancarias
									join reservas on transacoes_bancarias.cod_reserva = reservas.cod_reserva
									join clientes on reservas.cod_cliente = clientes.cod_cliente");
?>
<div class="row">
	<div class="col s12">
		<div class="card-panel">
			<h4 class="header2"><center>Transações Encontradas</center></h4><br>
			<table class="bordered">
                <thead>
                    <tr>
                        <th><center>Transação</center></th>
                        <th><center>Cliente</center></th>
                        <th><center>CPF</center></th>
                        <th><center>Status</center></th>
                        <th><center>Editar</center></th>
                    </tr>
                </thead>
                <tbody>
<?php
                    while(@$transacoes = mysqli_fetch_array(@$busca_transacoes)){
?>
                        <tr>
                            <td><center><?php echo $transacoes['cod_pagseguro']?></center></td>
                            <td><center><?php echo $transacoes['nome']?></center></td>
                            <td><center><?php echo $transacoes['cpf']?></center></td>
                            <td><center><?php echo $transacoes['status']?></center></td>
                            <td><center><a href="liberar-cliente.php?cod_transacao=<?=$transacoes['cod_transacao']?>" class="btn black"><i class="small material-icons">navigate_next</i></center></td>
                        </tr>
<?php  
                    }  
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
	if(@$_GET['cod_transacao']){
		@$transacao = $_GET['cod_transacao'];
		@$busca_dados = mysqli_query($link, "SELECT transacoes_bancarias.cod_transacao, transacoes_bancarias.cod_pagseguro, clientes.cod_cliente, clientes.nome, 
									clientes.cpf, transacoes_bancarias.status FROM transacoes_bancarias
									join reservas on transacoes_bancarias.cod_reserva = reservas.cod_reserva
									join clientes on reservas.cod_cliente = clientes.cod_cliente where cod_transacao='$transacao'");
		@$dados = mysqli_fetch_array(@$busca_dados);
		@$nome = @$dados['nome'];
		@$idtrans = @$dados['cod_pagseguro'];
		@$cod_transacao = @$dados['cod_transacao'];
		@$cod_cliente = @$dados['cod_cliente'];
?>		<div class="row">
			<div class="field col s3 offset-s1">
				<label>Transação</label>
				<input type="text" name="transacao" value="<?=@$idtrans?>">
			</div>
			<div class="field col s3">
				<label>Cliente</label>
				<input type="text" name="NOME" value="<?=@$nome?>">
			</div>
			<form action="liberar-cliente.php" method="post">
				<input type="hidden" name="cod_transacao" value="<?=@$cod_transacao?>">
				<input type="hidden" name="cod_cliente" value="<?=@$cod_cliente?>">
				<div class="input-field col s3">
					<select id="status" name="status">
						<option value="" disabled selected>Novo Status</option>
						<option value="P">Pendente</option>
		 				<option value="N">Negado</option>
						<option value="A">Aceito</option>
					</select>
				</div>
				<input type="submit" name="submit" class="btn black">
			</form>
<?php	}
    
    if(@$_POST['submit']){
    	@$trans = $_POST['cod_transacao'];
    	@$novo_status = $_POST['status'];
    	@$cliente = $_POST['cod_cliente'];
		@$atualiza_db = mysqli_query($link, "UPDATE transacoes_bancarias set status='$novo_status' where cod_transacao='$trans'");
    	if(@$novo_status == 'N'){
    		@$negativa_cliente = mysqli_query($link, "UPDATE clientes SET status_cliente='N' where cod_cliente='$cliente'");
    	}else{
    		@$libera_cliente = mysqli_query($link,"UPDATE clientes SET status_cliente='A' where cod_cliente='$cliente'");
    	}
    header('location:liberar-cliente.php');
	}
	include("footer.php");
?>