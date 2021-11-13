<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM motorista WHERE id_motorista=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhamotorista = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script type="text/javascript">
    $("#telefone").mask("(00) 0000-0000");
</script>

<script type="text/javascript">
    $("#cpf").mask("000.000.000-00");
</script>

<script type="text/javascript">
    $("#carteira").mask("00000000000");
</script>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Editar Motorista</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar Motorista</h1>
    <form action="editar_motorista.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id">ID</label>
            <input class="form-control" id="id" type="text" name="id_motorista" readonly value="<?php echo $linhamotorista->id_motorista;?>">
        </div>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" id="nome" type="text" name="nome_motorista" value="<?php echo $linhamotorista->nome_motorista;?>">
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input class="form-control" id="email" type="email" name="email_motorista" value="<?php echo $linhamotorista->email_motorista;?>">
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input class="form-control" id="cpf" type="text" name="cpf_motorista" value="<?php echo $linhamotorista->cpf_motorista;?>">
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" type="text" name="telefone_motorista" value="<?php echo $linhamotorista->telefone_motorista;?>">
        </div>

        <div class="form-group">
            <label for="carteira">Carteira de Motorista</label>
            <input class="form-control" id="carteira" type="text" name="carteira_de_motorista" value="<?php echo $linhamotorista->carteira_de_motorista;?>">
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input class="form-control" id="senha" type="password" name="senha_motorista">
        </div>

        <div class="form-group">
            <label for="confsenha">Confirmaçao da senha</label>
            <input class="form-control" id="confsenha" type="password" name="confsenha">
        </div>



        <button type="submit" class="btn btn-primary">Editar Motorista</button>
        <a href="listagem_motorista.php" class="btn btn-danger">Cancelar</a>
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
