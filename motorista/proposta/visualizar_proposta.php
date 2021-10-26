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
    orcamento.id_orcamento = 1");
    $resultado = $query->execute();

    $linha = $query->fetchObject();


    $query = $conexao->prepare("Select
    endereco.*,
    cidade.nome_cidade,
    estado.nome_estado
From
    endereco Inner Join
    estado On endereco.estado = estado.id_estado Inner Join
    cidade On cidade.estado_cidade = estado.id_estado
            And endereco.cidade = cidade.id_cidade
Where
    endereco.id_endereco = :endereco_partida");

    //novo select para buscar o dado do endereco 1 usar inner join para a cidade e estado
    //prepare\
    //bindparam ou value
    /// //execute
    /// linhaEndereco
    ///


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
    <title>Form-Editar Usuário</title>
</head>
<body>

<?php
include ("../configurações/bootstrap.php");
include ("../configurações/menu.php");

?>

<div class="container">
    <h1> Vizualizar Propostas</h1>
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
                        Collapsible Group Item #1
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="form-group">
                        <h6>Data e Horario </h6>
                        <?php echo $linha->data_e_horario; ?>
                    </div>
                    <div class="card-body">
                        </label><h6>Informaçoes </h6>
                        <?php echo $linha->inf_adicionais; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Collapsible Group Item #2
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                <div class="card-body">
                </label><h6>Endereço Partida </h6>
                <?php echo $linha->endereco_partida; ?>
                </div>

            </div>
        </div>
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Collapsible Group Item #3
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                <div class="card-body">
                    <h6>Endereço Destino </h6>
                    <?php echo $linha->endereco_destino; ?>
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
            <form>
                vai os dados para montar a proposta
            </form>
        </div>
    </div>


    </form>
</div>

