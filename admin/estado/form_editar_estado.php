<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM estado WHERE id_estado=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhaestado = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Editar Estado</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar - Estado</h1>
    <form action="editar_estado.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_estado">ID</label>
            <input class="form-control" id="id_estado" type="text" name="id_estado" readonly value="<?php echo $linhaestado->id_estado;?>">
        </div>

        <div class="form-group">
            <label for="nome_estado">Nome</label>
            <input class="form-control" id="nome_estado" type="text" name="nome_estado" value="<?php echo $linhaestado->nome_estado;?>">
        </div>

        <button type="submit" class="btn btn-primary">Editar Estado</button>
        <a href="../estado/listagem_estado.php" class="btn btn-danger">Cancelar</a>
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
