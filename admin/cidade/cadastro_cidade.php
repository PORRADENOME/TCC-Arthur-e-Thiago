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
            <label for="estado_cidade">Estado</label>
            <br>
            <select class="form-control form-select-lg" id="estado_cidade" name="estado_cidade" required>
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