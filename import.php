<html lang="br">
<style> 
input[type=submit]{
    background-color: #020000;
    border: none;
    color: #FFF;
    padding: 0 2rem;
    text-align: center;
    text-decoration: none;
    text-transform: uppercase;
    height: 36px;
    letter-spacing: 0.5px;
    cursor: pointer;
}
</style>
<script>
</script>
<head>
    <?php
        include("header.php");
        include("database.php");
        @$ext_permitida = array('.json');
        @$extensao = strrchr($_FILES['jsonFile']['name'],'.');

        if(isset($_POST['buttomImport'])===true)
        {
                if(in_array($extensao, $ext_permitida) === true){

                    if($ext_permitida==true){

                        copy($_FILES['jsonFile']['tmp_name'], 'jsonFiles/'.$_FILES['jsonFile']['name']);
                        $data = file_get_contents('jsonFiles/'.$_FILES['jsonFile']['name']);
                        $clientes = json_decode($data);

                        foreach ($clientes as $cliente)
                        {
                            $stmt = $conn->prepare('INSERT INTO clientes(nome,cpf,status_cliente,sexo,email,telefone,endereco,forma_pagamento) VALUES (:nome, :cpf, :status_cliente, :sexo, :email, :telefone, :endereco, :forma_pagamento)');
                            $stmt->bindValue('nome', $cliente->nome);
                            $stmt->bindValue('cpf', $cliente->cpf);
                            $stmt->bindValue('status_cliente', $cliente->status_cliente);
                            $stmt->bindValue('sexo', $cliente->sexo);
                            $stmt->bindValue('email', $cliente->email);
                            $stmt->bindValue('telefone', $cliente->telefone);
                            $stmt->bindValue('endereco', $cliente->endereco);   
                            $stmt->bindValue('forma_pagamento', $cliente->forma_pagamento);            
                            $stmt->execute();  
                        }
                        echo "<script>alert('Importação realizada com sucesso');</script>";  
                }
            }else{  
            echo "<script>alert('Extensão de arquivo não permitida');</script>";
            }
        }
    ?>
</head>

<body>
    <div class="col 12">
        <div class="card-panel">
                <h4 class="header2" style="text-align: center">Importação de dados</h4>
                <form method="POST" enctype="multipart/form-data">
                <div style="margin-left: 18%;">
                    <div class="file-field input-field">     
                        <div class="btn black">
                            <span>File</span>
                            <input type="file" name="jsonFile">
                        </div>
                        <div class="file-path-wrapper" style="margin-left: 0%; width: calc(90% - 100px);">
                            <input class="file-path validate" type="text" disabled value="Arquivos em formato Json">
                        </div>
                    </div>
                    <div class="btn black" style="margin-left:70%">
                        <input type="submit" value="Importar" name="buttomImport">
                    </div>
                </div>
                </form>
        </div>
    </div>
</body>

<footer>
    <?php
        include("footer.php");
    ?>
</footer>

</html>

