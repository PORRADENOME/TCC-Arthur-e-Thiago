<?php


require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM endereco WHERE id_endereco=:id");
    $query->bindValue(":id", $_GET['id']);

    $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhaendereco = $query->fetchObject();

    $resultado = $conexao->prepare("SELECT * FROM estado");
    $resultado->execute();
    $arr_estados = $resultado->fetchAll();

}catch (PDOException $exception){
    echo $exception->getMessage();
}


?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<script type="text/javascript">
    $("#numero").mask("0000");
</script>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Editar EndereÇo</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar Endereço</h1>
    <form action="editar_endereco.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_endereco">ID</label>
            <input class="form-control" id="id_endereco" type="text" name="id_endereco" readonly value="<?php echo $linhaendereco->id_endereco;?>">
        </div>

        <div class="form-group">
            <label for="nome_endereco">Nome</label>
            <input class="form-control" id="nome_endereco" type="text" name="nome_endereco" value="<?php echo $linhaendereco->nome_endereco;?>">
        </div>

        <div class="form-group">
            <label for="pais">País</label>
            <input class="form-control" id="pais" type="text" name="pais" value="<?php echo $linhaendereco->pais;?>">
        </div>

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

        <div class="form-group">
            <label for="bairro">Bairro</label>
            <input class="form-control" id="bairro" type="text" name="bairro" value="<?php echo $linhaendereco->bairro;?>">
        </div>

        <div class="form-group">
            <label for="rua">Rua</label>
            <input class="form-control" id="rua" type="text" name="rua" value="<?php echo $linhaendereco->rua;?>">
        </div>

        <div class="form-group">
            <label for="numero">Número</label>
            <input class="form-control" id="numero" type="text" name="numero" value="<?php echo $linhaendereco->numero;?>">
        </div>

        <div class="form-group">
            <label for="complemento">Complemento</label>
            <input class="form-control" id="complemento" type="text" name="complemento" value="<?php echo $linhaendereco->complemento;?>">
        </div>



        <button type="submit" class="btn btn-primary">Editar Endereço</button>
        <a href="../endereco/listagem_endereco.php" class="btn btn-danger">Cancelar</a>
    </form>
</div>

<script>
    $(document).ready(function (){
        $('.jsonForm').ajaxForm({
            dataType: 'json',
            success: function (data) {
                if(data.status==true) {
                    iziToast.success({
                        message: data.mensagem,
                        onClosing: function(){
                            history.back();
                        }
                    });

                }else{
                    iziToast.error({
                        message: data.mensagem
                    });
                }
            },
            error:function (data){
                 iziToast.error({
                       mensage:'Servidor retornou erro. '
                  });
             }
        });

        $('#estado').on('change', function() {
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
