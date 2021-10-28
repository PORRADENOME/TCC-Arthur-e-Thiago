<?php
// include "../seguranca.php";

try {
    include "../configurações/conexao.php";
    require "../configurações/segurança.php";

    $queryCliente = $conexao->query("SELECT * FROM motorista ORDER BY nome ASC");

    $queryAtendente = $conexao->query("SELECT * FROM atendente ORDER BY nome ASC");

} catch (PDOException $exception ) {
    echo $exception->getMessage();
}

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Atendimento</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.18/dist/js/bootstrap-select.min.js"></script>

<div class="container">
<form action="inserir.php" method="post" class="jsonForm">
    <h1>Atendimento - Novo</h1>
	<div class="form-group">
		<label for="idcliente">Cliente</label>
		<select class="form-control selectpicker" id="idcliente" name="idcliente" required data-live-search="true">
            <option value="">- Selecione o Cliente -</option>
            <?php
            while($linhaCliente = $queryCliente->fetch()){
                echo "<option value='{$linhaCliente->id}'>{$linhaCliente->nome}</option>";
            }
            ?>
        </select>
	</div>

    <div class="form-group">
        <label for="idatendente">Atendente</label>
        <select class="form-control selectpicker" id="idatendente" name="idatendente" required data-live-search="true">
            <option value="">- Selecione o Atendente -</option>
            <?php
            while($linhaAtendente = $queryAtendente->fetch()){
                echo "<option value='{$linhaAtendente->id}'>{$linhaAtendente->nome}</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>
</div>

<script>
    $(document).ready(function() {
        $('.jsonForm').ajaxForm({
            dataType:  'json',
            success:   function(data){
                if (data.status==true){
                    iziToast.success({
                        message: data.mensagem,
                    });
                    document.location = 'formCadastrarItens.php?id=' + data.id
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
