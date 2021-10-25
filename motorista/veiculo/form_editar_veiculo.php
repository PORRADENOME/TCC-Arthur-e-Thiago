<?php


require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM veiculo WHERE id_veiculo=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhaveiculo = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Form-Editar Veiculo</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar - Veiculo</h1>
    <form action="editar_veiculo.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_veiculo">ID</label>
            <input class="form-control" id="id_veiculo" type="text" name="id_veiculo" readonly value="<?php echo $linhaveiculo->id_veiculo;?>">
        </div>

        <div class="form-group">
            <label for="numero_chassi_veiculo">numero_chassi</label>
            <input class="form-control" id="numero_chassi_veiculo" type="text" name="numero_chassi_veiculo" value="<?php echo $linhaveiculo->numero_chassi_veiculo;?>">
        </div>

        <div class="form-group">
            <label for="marca_veiculo">marca</label>
            <input class="form-control" id="marca_veiculo" type="text" name="marca_veiculo" value="<?php echo $linhaveiculo->marca_veiculo;?>">
        </div>

        <div class="form-group">
            <label for="modelo_veiculo">modelo</label>
            <input class="form-control" id="modelo_veiculo" type="text" name="modelo_veiculo" value="<?php echo $linhaveiculo->modelo_veiculo;?>">
        </div>

        <div class="form-group">
            <label for="ano_veiculo">ano</label>
            <input class="form-control" id="ano_veiculo" type="text" name="ano_veiculo" value="<?php echo $linhaveiculo->ano_veiculo;?>">
        </div>


        <div class="form-group">
            <label for="placa_veiculo">placa</label>
            <input class="form-control" id="placa_veiculo" type="text" name="placa_veiculo" value="<?php echo $linhaveiculo->placa_veiculo;?>">
        </div>

        <div class="form-group">
            <label for="tipo_veiculo">tipo</label>
            <input class="form-control" id="tipo_veiculo" type="text" name="tipo_veiculo" value="<?php echo $linhaveiculo->tipo_veiculo;?>">
        </div>




        <button type="submit" class="btn btn-primary">Editar veiculo</button>
        <a href="../veiculo/listagem_veiculo.php" class="btn btn-danger">Cancelar</a>
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
    });
</script>

</body>
</html>
