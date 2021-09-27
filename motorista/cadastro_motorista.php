<?php
require "../configurações/segurança.php";
try{
    include "../configurações/conexao.php";



}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Motorista</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_motorista.php" method="post" class="jsonForm">
        <h1>Cadastro - Motorista</h1>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" id="nome" type="text" name="nome" required >
        </div>

        <div class="form-group">
            <label for="motorista">CPF</label>
            <input class="form-control" id="motorista" type="text" name="motorista" required >
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input class="form-control" id="email" type="email" name="email" required >
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input class="form-control" id="senha" type="password" name="senha" required >
        </div>
        <div class="form-group">
            <label for="confsenha">Confirmaçao de senha</label>
            <input class="form-control" id="confsenha" type="password" name="confsenha" required >
        </div>

<button type="submit" class="btn btn-primary">Cadastrar Motorista</button>
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
