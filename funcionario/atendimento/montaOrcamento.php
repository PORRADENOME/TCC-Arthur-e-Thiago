<?php

// require_once "../seguranca.php";

try {
    include_once "../configurações/conexao.php";

    if (!isset($_GET['id'])){
        die('Acesse através da listagem');
    }

    $queryServico = $conexao->prepare("Select
    atendimento_servico.id,
    atendimento_servico.valor,
    servico.nome
From
    atendimento_servico Inner Join
    servico On atendimento_servico.idservico = servico.id
Where
    atendimento_servico.idatendimento=:id ");

    $queryServico->bindParam(":id", $_GET['id']);
    $queryServico->execute();

    $queryProduto = $conexao->prepare("Select
    atendimento_produto.quantidade,
    produto.nome,
    atendimento_produto.valorproduto,
    atendimento_produto.id
From
    atendimento_produto Inner Join
    produto On atendimento_produto.idproduto = produto.id
Where
    atendimento_produto.idatendimento=:id  ");

    $queryProduto->bindParam(":id", $_GET['id']);
    $queryProduto->execute();

    $queryAtendimento = $conexao->prepare("Select

    atendimento.formapagamento,
    cliente.nome As cliente_nome,
    atendente.nome As atendente_nome,
    atendimento.id,
    atendimento.valortotal,
    atendimento.desconto,
    data
From
    atendimento Inner Join
    atendente On atendimento.idatendente = atendente.id Inner Join
    cliente On atendimento.idcliente = cliente.id
    where 
    atendimento.id=:id 
    
    ");

    $queryAtendimento->bindParam(":id", $_GET['id']);
    $queryAtendimento->execute();

    $linha = $queryAtendimento->fetchObject();

} catch (PDOException $exception ) {
    echo $exception->getMessage();
}

?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Finalizaçao <?php echo $_GET['id']; ?></h2>
            <div class="card">
                <div class="card-header">
                    Dados do atendimento
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="idcliente" class="col-sm-2 col-form-label">Forma de pagamento</label>
                        <div class="col-sm-10">
                            <?php echo $linha->formapagamento; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idcliente" class="col-sm-2 col-form-label">Atendente</label>
                        <div class="col-sm-10">
                            <?php echo $linha->atendente_nome; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idcliente" class="col-sm-2 col-form-label">Cliente</label>
                        <div class="col-sm-10">
                            <?php echo $linha->cliente_nome; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="data" class="col-sm-2 col-form-label">Data</label>
                        <div class="col-sm-10">
                            <?php echo $linha->data; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="desconto" class="col-sm-2 col-form-label">Desconto</label>
                        <div class="col-sm-10">
                            <?php echo $linha->desconto; ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="valortotal" class="col-sm-2 col-form-label">Valor Final</label>
                        <div class="col-sm-10">
                            <?php echo $linha->valortotal; ?>
                        </div>
                    </div>
                </div>
            </div>

            <h3>Produtos</h3>
            <table class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th>Produto</th>
                    <th>Valor</th>
                    <th>quantidade</th>

                </tr>
                </thead>
                <tbody>
                <?php
                while($linhaProduto = $queryProduto->fetch()){
                    echo "<tr>";
                    echo "<td>" . $linhaProduto->nome ."</td>";
                    echo "<td>" . $linhaProduto->valorproduto ."</td>";
                    echo "<td>" . $linhaProduto->quantidade ."</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>

            <h3>Serviços</h3>
            <table class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                </tr>
                </thead>
                <tbody>
                <?php
                while($linhaServico = $queryServico->fetch()){
                    echo "<tr>";
                    echo "<td>" . $linhaServico->nome ."</td>";
                    echo "<td>" . $linhaServico->valor ."</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>


            <div class="float-right buttons">
                <a href="index.php" class="btn btn-primary">Voltar</a>
            </div>

        </div>
    </div>
</div>


