<?php

require "../configurações/segurança.php";
try{
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM endereco WHERE cliente_endereco={$_SESSION['id']}");
    $resultado = $query ->execute();
    $arr_endereco = $query->fetchAll();


}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Orçamento</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
/*    Method 1:

$(document).ready(function(){
$('#data_e_horario').val(new Date().toJSON().slice(0,19));
});

__Method 2:__
*/
function zeroPadded(val) {
if (val >= 10)
return val;
else
return '0' + val;
}

$(document).ready(function(){

    $('#data_e_horario').attr("min", moment().add(7, 'days').format("yyyy-MM-DD\TH:mm") );
    $('#data_e_horario').attr("max", moment().add(6, 'months').format("yyyy-MM-DD\TH:mm") );
});
</script>


<div class="container">
    <form action="inserir_orcamento.php" method="post" class="jsonForm">
        <h1>Cadastro de Orçamento</h1>

        <div class="form-group">
            <label for="data_e_horario">Data e horário</label>
            <input class="form-control" id="data_e_horario" type="datetime-local" name="data_e_horario" required >
        </div>

        <div class="form-group">
            <label for="inf_adicionais">Informações adicionais</label>
            <textarea class="form-control" id="inf_adicionais" name="inf_adicionais"></textarea>
        </div>

        <div class="form-group">
            <label for="endereco_partida">Endereço Partida</label>
            <br>
            <select class="form-control form-select-lg" id="endereco_partida" name="endereco_partida" required>
                <option>Selecione um endereço</option>

                <?php
                /*
                while ($linha = $query->fetchObject()):
                ?>
                    <option value="<?php echo $linha->id_estado; ?>"><?php echo $linha->nome_estado; ?></option>';
                <?php
                endwhile;
                ?>*/

                foreach ( $arr_endereco as $endereco) {
                    echo '<option value="' . $endereco->id_endereco . '">' . $endereco->nome_endereco . '</option>';
                }
                ?>


            </select>
        </div>

        <div class="form-group">
            <label for="endereco_destino">Endereço Destino</label>
            <br>
            <select class="form-control form-select-lg" id="endereco_destino" name="endereco_destino" required disabled>
                <option>Selecione um endereço</option>


            </select>
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

        $('#endereco_partida').on('change', function() {
            $.post(
                "/orcamento/selecao_endereco_destino.php",
                {id: this.value},
                function (data) {

                    $("#endereco_destino").empty();
                    $("#endereco_destino").append($('<option>', {
                        //value: null,
                        text : "Selecione uma cidade"
                    }));

                    // equivalente ao foreach()
                    $.each(data, function (i, item) {

                        console.log(item)

                        $('#endereco_destino').append($('<option>', {
                            value: item.id_endereco,
                            text : item.nome_endereco
                        }));

                    });

                    $( "#endereco_destino" ).prop( "disabled", false );

                },
                "json"
            );

        });
    });


</script>
</body>
</html>

