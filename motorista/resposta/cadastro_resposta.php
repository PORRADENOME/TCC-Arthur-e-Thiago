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
    <title>Cadastro de Avaliacao</title>
</head>
<body>

<?php
include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<div class="container">
    <form action="inserir_resposta.php" method="post" class="jsonForm">
        <h1>Cadastro - Avaliacao</h1>

        <div class="form-group">
            <label for="texto_avaliacao">Testo</label>
            <input class="form-control" id="texto_resposta" type="text" name="texto_resposta" required >
        </div>

        <div class="form-group">
            <label for="data_avaliacao">Data</label>
            <input class="form-control" id="data_resposta" type="text" name="data_resposta" required >
        </div>


<button type="submit" class="btn btn-primary" >Enviar resposta</button>
<a href="../avaliacao/listagem_avaliacao.php" class="btn btn-danger">Sair</a>

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
