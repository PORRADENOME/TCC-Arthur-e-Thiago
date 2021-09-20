<?php
try{

    include "../configurações/conexao.php";

    require "../configurações/segurança.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM atendente WHERE id=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhaatendente = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Form-Editar atendente</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Editar - atendente</h1>
    <form action="editar_atendente.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id">ID</label>
            <input class="form-control" id="id" type="text" name="id" readonly value="<?php echo $linhaatendente->id;?>">
        </div>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" id="nome" type="text" name="nome" value="<?php echo $linhaatendente->nome;?>">
        </div>

        <div class="form-group">
            <label for="funcao">funcao</label>
            <input class="form-control" id="funcao" type="text" name="funcao" value="<?php echo $linhaatendente->funcao;?>">
        </div>

        <div class="form-group">
            <label for="telefone">descricao</label>
            <input class="form-control" id="telefone" type="text" name="telefone" value="<?php echo $linhaatendente->telefone;?>">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar atendente</button>
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
