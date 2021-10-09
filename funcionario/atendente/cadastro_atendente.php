<?php
try{
    include "../configurações/conexao.php";
    require "../configurações/segurança.php";


}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro atendente</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_atendente.php" method="post" class="jsonForm">
        <h1>Cadastro - atendente</h1>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" id="nome" type="text" name="nome" required >
        </div>

        <div class="form-group">
            <label for="funcao">funcao</label>
            <input class="form-control" id="funcao" type="text" name="funcao" required>
        </div>

        <div class="form-group">
            <label for="descricao">telefone</label>
            <input class="form-control" id="telefone" type="text" name="telefone" required>
        </div>

<button type="submit" class="btn btn-primary">Cadastrar - atendente</button>
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
