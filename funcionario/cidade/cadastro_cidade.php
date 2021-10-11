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
    <title>Cadastro de Cidade</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_cidade.php" method="post" class="jsonForm">
        <h1>Cadastro - Cidade</h1>

        <div class="form-group">
            <label for="nome">Cidade</label>
            <input class="form-control" id="nome" type="text" name="nome" required >
        </div>
        <div class="form-group">
            <label for="estado_cidade">Selecione o Estado</label>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" id="estado_cidade" name="estado_cidade">
                <option value="1">São Paulo</option>
                <option value="2">Paraná</option>
                <option value="3">Santa Catarina</option>
                <option value="3">Rio de Janeiro</option>
                <option value="3">Rio Grande do Sul</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Cidade</button>
        <a href="../cidade/listagem_cidade.php" class="btn btn-danger">Cancelar</a>

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