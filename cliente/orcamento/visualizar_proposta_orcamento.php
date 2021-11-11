<?php

require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    $query = $conexao->prepare("Select
    proposta.preco,
    proposta.informacoes_adicionais
From
    proposta WHERE id_proposta=:id");
    $query->bindValue(':id', $_GET['id']);

    echo ($_GET['id']);

    $resultado = $query->execute();


    $linha = $query->fetchObject();

    var_dump($linha);

}catch(PDOException $exception){
    echo $exception->getMessage();

    include("../configurações/bootstrap.php");
    include("../configurações/menu.php");
}

?>




<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Visualizar Proposta</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Vizualizar Proposta</h1>
    <p></p>
    <p></p>


        <div class="form-group">
    </div>

    <div class="form-group">
    </div>

    <div class="form-group">
    </div>

    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Informaçoes gerais
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="card-body">
                        <h6>Data e Horario </h6>
                        <?php echo $linha->preco; ?>
                    </div>

                    <div class="card-body">
                        <h6>Informaçoes </h6>
                        <?php echo $linha->informacoes_adicionais; ?>
                    </div>

                </div>
            </div>
        </div>

    <p>
        <a class="btn btn-primary" href="../orcamento/aceitar.php">Aceitar</a>
        <button class="btn btn-primary" role="button" onclick="history.back()" >
            Voltar
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form>




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


            </form>
        </div>
    </div>


    </form>
</div>


