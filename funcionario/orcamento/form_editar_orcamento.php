<?php


require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM orcamento WHERE id_orcamento=id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhaorcamento = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Form-Editar Orçamento</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar - Orçamento</h1>
    <form action="editar_orcamento.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_orcamento">ID</label>
            <input class="form-control" id="id_orcamento" type="text" name="id_orcamento" readonly value="<?php echo $linhaorcamento->id_orcamento;?>">
        </div>

        <div class="form-group">
            <label for="data_e_horario">Data e horario</label>
            <input class="form-control" id="data_e_horario" type="text" name="data_e_horario" value="<?php echo $linhaorcamento->data_e_horario;?>">
        </div>

        <div class="form-group">
            <label for="inf_adicionais">Informaçoes extras</label>
            <input class="form-control" id="inf_adicionais" type="text" name="inf_adicionais" value="<?php echo $linhaorcamento->inf_adicionais;?>">
        </div>



        <button type="submit" class="btn btn-primary">Editar orçamento</button>
        <a href="../orcamento/listagem_orcamento.php" class="btn btn-danger">Cancelar</a>
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
