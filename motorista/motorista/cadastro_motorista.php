<?php
try{
    include "../configurações/conexao.php";



}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script type="text/javascript">
    $("#telefone").mask("(00) 0000-00009");
</script>

<script type="text/javascript">
    $("#cpf").mask("000.000.000-00");
</script>

<script type="text/javascript">
    $("#carteira").mask("00000000000");
</script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Motorista</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
?>

<div class="container">
    <form action="inserir_motorista.php" method="post" class="jsonForm">
        <h1>Cadastro - Motorista</h1>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" id="nome" type="text" name="nome" required >
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input class="form-control" id="cpf" type="text" name="cpf" required >
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input class="form-control" id="email" type="email" name="email" required >
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" type="text" name="telefone" pattern="\([0-9]{2}\)[\s][0-9]{4}-[0-9]{4,5}">
        </div>
        <div class="form-group">
            <label for="carteira">Carteira de motorista</label>
            <input class="form-control" id="carteira" type="text" name="carteira" required >
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input class="form-control" id="senha" type="password" name="senha" required >
        </div>
        <div class="form-group">
            <label for="confsenha">confirmaçao de senha</label>
            <input class="form-control" id="confsenha" type="password" name="confsenha" required >
        </div>



        <button type="submit" class="btn btn-primary">Cadastrar Motorista</button>
        <a href="../configurações/index.php" class="btn btn-danger">Cancelar</a>

    </form>
</div>

<script>
    $(document).ready(function () {
        $(' .jsonForm ').ajaxForm({
            dataType: 'json',
            success: function (data) {
                if (data.status==true){
                    iziToast.success({
                        message: data.mensagem,
                        onClosing: function(){
                            history.back();
                        }
                    });
                    $('.jsonForm').trigger('reset');
                }else{
                    iziToast.error({
                        message: data.mensagem
                    });
                }
            },
            error: function (data) {
                iziToast.error({
                    message: 'Servidor retornou erro'
                });
            }
        });
    });
</script>
</body>
</html>