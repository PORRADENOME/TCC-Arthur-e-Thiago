<?php

require "../configurações/segurança.php";
try{
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM estado");
    $resultado = $query ->execute();
    $arr_estados = $query->fetchAll();


}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Área de Atuação</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_area_atuacao.php" method="post" class="jsonForm">
        <h1>Cadastro - Área de Atuação</h1>

            <div class="form-group">
            <label for="estado">Estado</label>
            <br>
            <select class="form-control form-select-lg" id="estado" name="estado" required>
                <option>Selecione um estado</option>

                <?php
                foreach ( $arr_estados as $estado) {
                    echo '<option value="' . $estado->id_estado . '">' . $estado->nome_estado . '</option>';
                }
                ?>


            </select>
        </div>

        <div class="form-group">
            <label for="cidade">Cidade</label>
            <br>
            <select class="form-control form-select-lg" id="cidade" name="cidade" required disabled>
                <option selected>Selecione uma cidade</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar</button>
        <a href="../area_atuação/listagem_area_atuacao.php" class="btn btn-danger">Voltar</a>

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

        $('#estado').on('change', function() {
            $.post(
                "/area_atuação/cidades_por_estado.php",
                {id: this.value},
                function (data) {

                    $("#cidade").empty();
                    $("#cidade").append($('<option>', {
                        //value: null,
                        text : "Selecione uma cidade"
                    }));

                    // equivalente ao foreach()
                    $.each(data, function (i, item) {

                        console.log(item)

                        $('#cidade').append($('<option>', {
                            value: item.id_cidade,
                            text : item.nome_cidade
                        }));

                    });

                    $( "#cidade" ).prop( "disabled", false );

                },
                "json"
            );

        });

    });
</script>
</body>
</html>