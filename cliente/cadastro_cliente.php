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
    <title>Cadastro de cliente</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_cliente.php" method="post" class="jsonForm">
        <h1>Cadastro - cliente</h1>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" id="nome" type="text" name="nome" required >
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" id="email" type="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="telefone">telefone</label>
            <input class="form-control" id="telefone" type="text" name="telefone" required>
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input class="form-control" id="cpf" type="text" name="cpf" required>
        </div>

        <div class="form-group">
            <label for="datanascimento">datanascimento</label>
            <input class="form-control" id="datanascimento" type="date" name="datanascimento" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar cliente</button>
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
