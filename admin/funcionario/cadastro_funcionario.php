<?php
require "../configurações/segurança.php";
try{
    include "../configurações/conexao.php";



}catch (PDOException $exception){
    echo $exception->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>

    <?php
    include("../configurações/bootstrap.php");
    include("../configurações/menu.php");
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">



        $(document).ready(function(){
            $("#cpf").mask("000.000.000-00");
            $("#telefone").mask("(00) 000000009");
        });
    </script>
</head>
<body>

<div class="container">
    <form action="inserir_funcionario.php" method="post" class="jsonForm">
        <h1>Cadastro de Funcionário</h1>

        <div class="form-group">
            <label for="nome">Nome</label>
            <input class="form-control" id="nome" type="text" name="nome" required >
        </div>

        <div class="form-group">
            <label for="cpf">CPF</label>
            <input class="form-control" id="cpf" type="text" name="cpf" required >
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input class="form-control" id="email" type="email" name="email" required >
        </div>

        <div class="form-group">
            <label for="telefone">Telefone</label>
            <input class="form-control" id="telefone" type="text" name="telefone" required>
        </div>

        <div class="form-group">
            <label for="valor">Funcionário ou Administrador?</label>
            <select class="form-control form-select-lg" id="valor"name="valor" required >
                <option>Selecione uma opção</option>
                <option value="1">Administrador</option>
                <option value="0">Funcionário</option>
            </select>
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input class="form-control" id="senha" type="password" name="senha" required >
        </div>
        <div class="form-group">
            <label for="confsenha">Confirmação de senha</label>
            <input class="form-control" id="confsenha" type="password" name="confsenha" required >
        </div>

<button type="submit" class="btn btn-primary">Cadastrar Funcionário</button>
<a href="../funcionario/listagem_funcionario.php" class="btn btn-danger">Cancelar</a>

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
