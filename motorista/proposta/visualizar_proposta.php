<?php
require "../configurações/segurança.php";
try{

    include "../configurações/conexao.php";

    $query = $conexao->prepare("Select
    orcamento.*,
    cliente.nome_cliente
From
    orcamento Inner Join
    endereco On orcamento.endereco_partida = endereco.id_endereco Inner Join
    cliente On endereco.cliente_endereco = cliente.id_cliente
Where
    orcamento.id_orcamento=:id; ");
    $query->bindValue(":id", $_GET['id']);
    $resultado = $query->execute();

    $linha1 = $query->fetchObject();


  /*  $query = $conexao->prepare("Select
    cidade.estado_cidade,
    estado.id_estado,
    estado.nome_estado,
    cidade.nome_cidade
From
    cidade Inner Join
    estado On cidade.estado_cidade = estado.id_estado
    ");

    $resultado = $query->execute();

    $linha1 = $query->fetchObject();
*/

    $query = $conexao->prepare("Select
    orcamento.endereco_partida,
    endereco.*,
    cidade.nome_cidade,
    estado.nome_estado
From
    orcamento Inner Join
    endereco On orcamento.endereco_partida = endereco.id_endereco Inner Join
    cidade On endereco.cidade = cidade.id_cidade Inner Join
    estado On endereco.estado = estado.id_estado
            And cidade.estado_cidade = estado.id_estado
            WHERE orcamento.id_orcamento=:id ");

    $query->bindValue(":id", $_GET['id']);

    $resultado = $query->execute();

    $linha2 = $query->fetchObject();

    $query = $conexao->prepare("Select
    endereco.*,
    orcamento.endereco_destino,
    cidade.nome_cidade,
    estado.nome_estado
From
    orcamento Inner Join
    endereco On orcamento.endereco_destino = endereco.id_endereco Inner Join
    cidade On endereco.cidade = cidade.id_cidade Inner Join
    estado On endereco.estado = estado.id_estado
            And cidade.estado_cidade = estado.id_estado
            WHERE orcamento.id_orcamento=:id");
    $query->bindValue(":id", $_GET['id']);
    $resultado = $query->execute();

    $linha3 = $query->fetchObject();


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
    <title>Orçamento e Proposta</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1>Pedido de Orçamento de <?php echo $linha1->nome_cliente; ?></h1>
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
                        <h6>Nome </h6>
                        <?php echo $linha1->nome_cliente; ?>
                    </div>

                    <div class="card-body">
                        <h6>Informaçoes </h6>
                        <?php echo $linha1->inf_adicionais; ?>
                    </div>

                    <div class="card-body">
                        <h6>Data e Horario </h6>
                        <?php echo $linha1->data_e_horario; ?>
                    </div>
                </div>
            </div>
        </div>



        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Informaçoes partida
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                <h6>Nome local </h6>
                <?php echo $linha2->nome_endereco; ?>
                </div>

                <div class="card-body">
                    <h6>Pais </h6>
                    <?php echo $linha2->pais; ?>
                </div>

                <div class="card-body">
                    <h6>Estado </h6>
                    <?php echo $linha2->nome_estado; ?>
                </div>

                <div class="card-body">
                    <h6>Cidade </h6>
                    <?php echo $linha2->nome_cidade; ?>
                </div>

                <div class="card-body">
                    <h6>Bairro </h6>
                    <?php echo $linha2->bairro; ?>
                </div>

                <div class="card-body">
                    <h6>Rua </h6>
                    <?php echo $linha2->rua; ?>
                </div>

                <div class="card-body">
                    <h6>Número </h6>
                    <?php echo $linha2->numero; ?>
                </div>

                <div class="card-body">
                    <h6>Complemento </h6>
                    <?php echo $linha2->complemento; ?>
                </div>


            </div>
        </div>




        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Informações destino
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <h6>Nome local </h6>
                    <?php echo $linha3->nome_endereco; ?>
                </div>

                <div class="card-body">
                    <h6>Pais </h6>
                    <?php echo $linha3->pais; ?>
                </div>

                <div class="card-body">
                    <h6>Estado </h6>
                    <?php echo $linha3->nome_estado; ?>
                </div>

                <div class="card-body">
                    <h6>Cidade </h6>
                    <?php echo $linha3->nome_cidade; ?>
                </div>

                <div class="card-body">
                    <h6>Bairro </h6>
                    <?php echo $linha3->bairro; ?>
                </div>

                <div class="card-body">
                    <h6>Rua </h6>
                    <?php echo $linha3->rua; ?>
                </div>

                <div class="card-body">
                    <h6>Número </h6>
                    <?php echo $linha3->numero; ?>
                </div>

                <div class="card-body">
                    <h6>Complemento </h6>
                    <?php echo $linha3->complemento; ?>
                </div>
            </div>
        </div>
    </div>

    <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            Fazer proposta
        </a>
        <button class="btn btn-primary" role="button" onclick="history.back()" >
            Voltar
        </button>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">



                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Propostar</title>
                </head>
                <body>

                <div class="container">
                    <form action="inserir_proposta.php"  method="post" class="jsonForm">
                        <h1>Cadastro da Proposta</h1>

                        <div class="form-group">
                            <label for="id_orcamento">ID orçamento</label>
                            <input class="form-control" type="text" id="id_orcamento" name="id_orcamento" value="<?php echo $linha1->id_orcamento?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="preco">Preço</label>
                            <input class="form-control" id="preco"  type="number" step="0.01" max="99999999,99" name="preco" required >
                        </div>

                        <div class="form-group">
                            <label for="informacoes_adicionais">Informações Adicionais</label>
                            <textarea class="form-control" id="informacoes_adicionais" name="informacoes_adicionais"></textarea>
                        </div>




                        <button type="submit" class="btn btn-primary">Cadastrar proposta</button>

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

                    })
                </script>
                </body>
                </html>


            </form>
        </div>
    </div>


    </form>
</div>

