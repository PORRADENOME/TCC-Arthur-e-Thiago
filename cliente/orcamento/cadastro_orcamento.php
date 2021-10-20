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
    <title>Cadastro de Orcamento</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_orcamento.php" method="post" class="jsonForm">
        <h1>Cadastro - Orcamento</h1>

        <div class="form-group">
            <label for="data_e_horario">data_e_horario</label>
            <input class="form-control" id="data_e_horario" type="text" name="data_e_horario" required >
        </div>

        <div class="form-group">
            <label for="inf_adicionais">inf_adicionais</label>
            <input class="form-control" id="inf_adicionais" type="text" name="inf_adicionais" required >
        </div>

<button type="submit" class="btn btn-primary">Cadastrar Orcamento</button>
<a href="../orcamento/listagem_orcamento.php" class="btn btn-danger">Cancelar</a>

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

