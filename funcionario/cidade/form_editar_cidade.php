<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM cidade WHERE id_cidade=:id");
    $query->bindValue(":id", $_GET['id']);

    $query->execute();

    $resultado = $conexao->prepare("SELECT * FROM estado");
    $resultado->execute();
    $arr_estados = $resultado->fetchAll();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhacidade = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Editar Cidade</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar - Cidade</h1>
    <form action="editar_cidade.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_cidade">ID</label>
            <input class="form-control" id="id_cidade" type="text" name="id_cidade" readonly value="<?php echo $linhacidade->id_cidade;?>">
        </div>

        <div class="form-group">
            <label for="nome_cidade">Nome</label>
            <input class="form-control" id="nome_cidade" type="text" name="nome_cidade" value="<?php echo $linhacidade->nome_cidade;?>">
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

        <button type="submit" class="btn btn-primary">Editar Cidade</button>
        <a href="../cidade/listagem_cidade.php" class="btn btn-danger">Cancelar</a>
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
