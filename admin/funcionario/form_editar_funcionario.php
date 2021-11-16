<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    if(!isset($_GET['id'])){
        die('Acesse pela listagem');
    }

    $query = $conexao->PREPARE("SELECT * FROM funcionario WHERE id_funcionario=:id");
    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    if($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linhafuncionario = $query->fetchObject();

}catch (PDOException $exception){
    echo $exception->getMessage();
}

?>



<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Editar Funcionário</title>

    <?php
    include ("../configurações/bootstrap.php");
    include ("../configurações/menu.php");

    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $("#cpf_funcionario").mask("000.000.000-00");
            $("#telefone_funcionario").mask("(00) 000000009");
        });
    </script>
</head>
<body>



<div class="container">
    <h1> Editar Funcionário</h1>
    <form action="editar_funcionario.php" method="post" class="jsonForm">

        <div class="form-group">
            <label for="id_funcionario">ID</label>
            <input class="form-control" id="id_funcionario" type="text" name="id_funcionario" readonly value="<?php echo $linhafuncionario->id_funcionario;?>">
        </div>

        <div class="form-group">
            <label for="nome_funcionario">Nome</label>
            <input class="form-control" id="nome_funcionario" type="text" name="nome_funcionario" value="<?php echo $linhafuncionario->nome_funcionario;?>">
        </div>

        <div class="form-group">
            <label for="email_funcionario">E-mail</label>
            <input class="form-control" id="email_funcionario" type="email" name="email_funcionario" value="<?php echo $linhafuncionario->email_funcionario;?>">
        </div>

        <div class="form-group">
            <label for="cpf_funcionario">CPF</label>
            <input class="form-control" id="cpf_funcionario" type="text" name="cpf_funcionario" value="<?php echo $linhafuncionario->cpf_funcionario;?>">
        </div>

        <div class="form-group">
            <label for="telefone_funcionario">Telefone</label>
            <input class="form-control" id="telefone_funcionario" type="text" name="telefone_funcionario" value="<?php echo $linhafuncionario->telefone_funcionario;?>">
        </div>

        <div class="form-group">
            <label for="senha_funcionario">Senha</label>
            <input class="form-control" id="senha_funcionario" type="password" name="senha_funcionario">
        </div>

        <div class="form-group">
            <label for="confsenha">Confirmaçao da senha</label>
            <input class="form-control" id="confsenha" type="password" name="confsenha">
        </div>

        <button type="submit" class="btn btn-primary">Editar Funcionário</button>
        <a href="../funcionario/listagem_funcionario.php" class="btn btn-danger">Cancelar</a>
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
