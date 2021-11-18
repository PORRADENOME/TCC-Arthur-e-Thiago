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
    <title>Cadastro de Veiculo</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_veiculo.php" method="post" class="jsonForm">
        <h1>Cadastro - Veiculo</h1>

        <div class="form-group">
            <label for="numero_chassi">Número de chassi</label>
            <input class="form-control" id="numero_chassi" type="text" name="numero_chassi" required >
        </div>

        <div class="form-group">
            <label for="marca">Marca</label>
            <input class="form-control" id="marca" type="text" name="marca" required >
        </div>

        <div class="form-group">
            <label for="modelo">Modelo</label>
            <input class="form-control" id="modelo" type="text" name="modelo" required >
        </div>

        <div class="form-group">
            <label for="ano">Ano</label>
            <input class="form-control" id="ano" type="text" name="ano" required >
        </div>

        <div class="form-group">
            <label for="placa">Placa</label>
            <input class="form-control" id="placa" type="text" name="placa" required >
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <input class="form-control" id="tipo" type="text" name="tipo" required >
        </div>

<button type="submit" class="btn btn-primary">Cadastrar veiculo</button>
<a href="../veiculo/listagem_veiculo.php" class="btn btn-danger">Cancelar</a>

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

