<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM cliente WHERE id_cliente=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhacliente = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script type="text/javascript">
    $("#telefone_cliente").mask("(00) 0000-0000");
</script>

<script type="text/javascript">
    $("#cpf_cliente").mask("000.000.000-00");
</script>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Editar - Cliente</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar - Cliente</h1>
    <form action="editar_cliente.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_cliente">ID</label>
            <input class="form-control" id="id_cliente" type="text" name="id_cliente" readonly value="<?php echo $linhacliente->id_cliente;?>">
        </div>

        <div class="form-group">
            <label for="nome_cliente">Nome</label>
            <input class="form-control" id="nome_cliente" type="text" name="nome_cliente" value="<?php echo $linhacliente->nome_cliente;?>">
        </div>

        <div class="form-group">
            <label for="email_cliente">E-mail</label>
            <input class="form-control" id="email_cliente" type="email" name="email_cliente" value="<?php echo $linhacliente->email_cliente;?>">
        </div>

        <div class="form-group">
            <label for="cpf_cliente">CPF</label>
            <input class="form-control" id="cpf_cliente" type="text" name="cpf_cliente" value="<?php echo $linhacliente->cpf_cliente;?>">
        </div>

        <div class="form-group">
            <label for="telefone_cliente">Telefone</label>
            <input class="form-control" id="telefone_cliente" type="text" name="telefone_cliente" value="<?php echo $linhacliente->telefone_cliente;?>">
        </div>

        <div class="form-group">
            <label for="senha_cliente">Senha</label>
            <input class="form-control" id="senha_cliente" type="password" name="senha_cliente">
        </div>

        <div class="form-group">
            <label for="confsenha">Confirmaçao da senha</label>
            <input class="form-control" id="confsenha" type="password" name="confsenha">
        </div>

        <button type="submit" class="btn btn-primary">Editar Cliente</button>
        <a href="../cliente/listagem_cliente.php" class="btn btn-danger">Cancelar</a>
    </form>
</div>

<script>
    $(document).ready(function (){
        $('.jsonForm').ajaxForm({
            dataType: 'json',
            success: function (data) {
                if(data.status==true) {
                    iziToast.success({
                        message: data.mensagem,
                        onClosing: function(){
                            history.back();
                        }
                    });

                }else{
                    iziToast.error({
                        message: data.mensagem
                    });
                }
            },
            error:function (data){
                 iziToast.error({
                       mensage:'Servidor retornou erro. '
                  });
             }
        });
    });
</script>

</body>
</html>
