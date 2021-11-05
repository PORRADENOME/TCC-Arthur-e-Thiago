<?php

require "../configurações/segurança.php";
try{
    include "../configurações/conexao.php";

    $query = $conexao->prepare("SELECT * FROM endereco");
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

<div class="container">
    <form action="inserir_orcamento.php" method="post" class="jsonForm">
        <h1>Cadastro - Orçamento</h1>

        <div class="form-group">
            <label for="data_e_horario">Data e horário</label>
            <input class="form-control" id="data_e_horario" type="datetime-local" name="data_e_horario" required >
        </div>

        <div class="form-group">
            <label for="inf_adicionais">informaçõs_adicionais</label>
            <textarea class="form-control" id="inf_adicionais" name="inf_adicionais">
            </textarea>
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
            <select class="form-control form-select-lg" id="endereco_destino" name="endereco_destino" required>
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

