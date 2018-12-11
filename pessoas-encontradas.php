<?php
    include("header.php");
    include("conectar.php");
?>
<div class="row">
    <div class="col s12">
        <div class="card-panel">
<?php
            if ($_POST["pesquisar"]){
                $nome=$_POST['nome'];
                $result = mysqli_query($link,"SELECT * FROM clientes WHERE nome like '%$nome%'");
                //}else if($_POST["pesquisar"]){
                //@$cpf=$_POST['cpf'];
                //$result = mysqli_query($link,"SELECT * FROM clientes WHERE cpf='".$cpf."'");
            }

echo        "<div class='row'>";
echo            "<div class='col 12' style='margin-left: 44%'>";
echo                "<h4 class='header2'><center>Pessoas encontradas</center></h4>";
echo            "</div>";                   
echo        "</div>";
?>
            <table class="bordered">
                <thead>
                    <tr>
                        <th><center>Nome</center></th>
                        <th><center>CPF</center></th>
                        <th><center>Situação</center></th>
                        <th><center>Selecionar</center></th>
                    </tr>
                </thead>
                <tbody>
<?php
                    while(@$dados = mysqli_fetch_array(@$result)){
?>
                        <tr>
                            <td><center><?php echo $dados['nome']?></center></td>
                            <td><center><?php echo $dados['cpf']?></center></td>
                            <td><center>
<?php                           if ($dados['status_cliente']=="A"){
                                    echo "Apto";
                                }else{
                                    echo "Não Apto";
                                }
?>                          </center></td>
                            <td><center><a href="cliente.php?cod_cliente=<?=$dados['cod_cliente']?>" class="btn black"><i class="small material-icons">navigate_next</i></center></td>
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
    include("footer.php");
?>
