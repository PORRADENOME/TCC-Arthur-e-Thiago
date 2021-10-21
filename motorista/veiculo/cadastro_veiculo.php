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
            <label for="numero_chassi">numero de chassi</label>
            <input class="form-control" id="numero_chassi" type="text" name="numero_chassi" required >
        </div>

        <div class="form-group">
            <label for="marca_veiculo">marca</label>
            <input class="form-control" id="marca_veiculo" type="text" name="marca_veiculo" required >
        </div>

        <div class="form-group">
            <label for="modelo_veiculo">modelo</label>
            <input class="form-control" id="modelo_veiculo" type="text" name="modelo_veiculo" required >
        </div>

        <div class="form-group">
            <label for="ano_veiculo">ano</label>
            <input class="form-control" id="ano_veiculo" type="text" name="ano_veiculo" required >
        </div>

        <div class="form-group">
            <label for="placa_veiculo">placa</label>
            <input class="form-control" id="placa_veiculo" type="text" name="placa_veiculo" required >
        </div>

        <div class="form-group">
            <label for="tipo_veiculo">tipo</label>
            <input class="form-control" id="tipo_veiculo" type="text" name="tipo_veiculo" required >
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

