<?php

require "../configurações/segurança.php";
try{
    include "../configurações/conexao.php";



    do{

    $query = $conexao->prepare("SELECT * FROM estado");
    $linhaestado = $query->fetchObject();



        $quantidade_estados=27;

    }while ($linhaestado->id_estado<=$quantidade_estados);

}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Endereço</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_endereco.php" method="post" class="jsonForm">
        <h1>Cadastro - Endereço</h1>

        <div class="form-group">
            <label for="pais">País</label>
            <input class="form-control" id="pais" type="text" name="pais" required >
        </div>

        <div class="form-group">
            <label for="nome_estado">Estado</label>
            <br>
            <select class="form-select form-select-lg mb-3" id="nome_estado">
                <option selected>Selecione um estado</option>
                <option value="1"><?php echo $linhaestado->nome_estado?>></option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="nome_estado">Cidade</label>
            <br>
            <select class="form-select form-select-lg mb-3" id="nome_cidade" name="nome_cidade">
                <option selected>Selecione uma cidade</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>

        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input class="form-control" id="bairro" type="text" name="bairro" required >
        </div>

        <div class="form-group">
            <label for="rua">Rua</label>
            <input class="form-control" id="rua" type="text" name="rua" required >
        </div>

        <div class="form-group">
            <label for="numero">Número</label>
            <input class="form-control" id="numero" type="text" name="numero" required >
        </div>

        <div class="form-group">
            <label for="complemento">Complemento</label>
            <input class="form-control" id="complemento" type="text" name="complemento" required >
        </div>

<button type="submit" class="btn btn-primary">Cadastrar</button>
<a href="/listagem_endereco.php" class="btn btn-danger">Cancelar</a>

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

