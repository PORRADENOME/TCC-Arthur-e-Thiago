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
    <title>Cadastro de indereco</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_indereco.php" method="post" class="jsonForm">
        <h1>Cadastro - indereco</h1>

        <div class="form-group">
            <label for="pais_indereco">pais_indereco</label>
            <input class="form-control" id="pais_indereco" type="text" name="pais_indereco" required >
        </div>



        <div class="form-group">
            <label for="bairro_indereco">bairro_indereco</label>
            <input class="form-control" id="bairro_indereco" type="text" name="bairro_indereco" required >
        </div>

        <div class="form-group">
            <label for="rua_indereco">rua_indereco</label>
            <input class="form-control" id="rua_indereco" type="text" name="rua_indereco" required >
        </div>

        <div class="form-group">
            <label for="numero_indereco">numero_indereco</label>
            <input class="form-control" id="numero_indereco" type="text" name="numero_indereco" required >
        </div>

        <div class="form-group">
            <label for="complemento_indereco">complemento_indereco</label>
            <input class="form-control" id="complemento_indereco" type="text" name="complemento_indereco" required >
        </div>

<button type="submit" class="btn btn-primary">Cadastrar indereco</button>
<a href="../indereco/listagem_indereco.php" class="btn btn-danger">Cancelar</a>

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

