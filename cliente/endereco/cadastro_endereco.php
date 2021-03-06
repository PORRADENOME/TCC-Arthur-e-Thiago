<?php

require "../configurações/segurança.php";
try{
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM estado");
    $resultado = $query ->execute();
    $arr_estados = $query->fetchAll();





//    do{

//    $query = $conexao->prepare("SELECT * FROM estado");
//    $linhaestado = $query->fetchObject();
//
//
//
//        $quantidade_estados=27;
//
//    }while ($linhaestado->id_estado<=$quantidade_estados);

}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script type="text/javascript">
    $("#numero").mask("99999");
</script>

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
        <h1>Cadastro de Endereço</h1>

        <div class="form-group">
            <label for="nome_endereco">Dê um nome à este endereço.</label>
            <input class="form-control" id="nome_endereco" type="text" name="nome_endereco" required>
        </div>

        <div class="form-group">
            <label for="pais">País</label>
            <input class="form-control" id="pais" type="text" name="pais" required">
        </div>

        <div class="form-group">
            <label for="estado">Estado</label>
            <br>
            <select class="form-control form-select-lg" id="estado" name="estado" required>
                <option>Selecione um estado</option>

                <?php
                /*
                while ($linha = $query->fetchObject()):
                ?>
                    <option value="<?php echo $linha->id_estado; ?>"><?php echo $linha->nome_estado; ?></option>';
                <?php
                endwhile;
                ?>*/

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
            <input class="form-control" id="complemento" type="text" name="complemento" >
        </div>

<button type="submit" class="btn btn-primary">Cadastrar</button>
<a href="../endereco/listagem_endereco.php" class="btn btn-danger">Cancelar</a>

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
            //alert( this.value );

            // $.post( "/cidade/cidades_por_estado.php", function( data ) {
            //     //$( ".result" ).html( data );
            //     console.log(data)
            // });

            $.post(
                "/endereco/cidades_por_estado.php",
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

