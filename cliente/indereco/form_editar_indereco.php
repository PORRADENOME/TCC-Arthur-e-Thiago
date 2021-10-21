<?php


require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM indereco WHERE id_indereco=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhaindereco = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Form-Editar indereco</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar - indereco</h1>
    <form action="editar_indereco.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_indereco">ID</label>
            <input class="form-control" id="id_indereco" type="text" name="id_indereco" readonly value="<?php echo $linhaindereco->id_indereco;?>">
        </div>

        <div class="form-group">
            <label for="pais_indereco">Pais</label>
            <input class="form-control" id="pais_indereco" type="text" name="pais_indereco" value="<?php echo $linhaindereco->data_e_horario_indereco;?>">
        </div>

        <div class="form-group">
            <label for="bairro_indereco">Bairro</label>
            <input class="form-control" id="bairro_indereco" type="text" name="bairro_indereco" value="<?php echo $linhaindereco->inf_adicionais_indereco;?>">
        </div>

        <div class="form-group">
            <label for="rua_indereco">Rua</label>
            <input class="form-control" id="rua_indereco" type="text" name="rua_indereco" value="<?php echo $linhaindereco->inf_adicionais_indereco;?>">
        </div>

        <div class="form-group">
            <label for="numero_indereco">Numero</label>
            <input class="form-control" id="numero_indereco" type="text" name="numero_indereco" value="<?php echo $linhaindereco->inf_adicionais_indereco;?>">
        </div>

        <div class="form-group">
            <label for="complemento_indereco">complemento_indereco</label>
            <input class="form-control" id="complemento_indereco" type="text" name="complemento_indereco" value="<?php echo $linhaindereco->inf_adicionais_indereco;?>">
        </div>



        <button type="submit" class="btn btn-primary">Editar Indereco</button>
        <a href="../indereco/listagem_indereco.php" class="btn btn-danger">Cancelar</a>
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
