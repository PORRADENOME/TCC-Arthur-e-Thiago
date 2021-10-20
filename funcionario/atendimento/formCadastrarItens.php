<?php
    // require "../seguranca.php";

try {
    include "../configurações/conexao.php";

    require "../configurações/segurança.php";

    if (!isset($_GET['id'])){
        die('Acesse através da listagem');
    }

    $query = $conexao->prepare("		
		Select
    motorista.nome As cliente_nome,
    atendente.nome As atendente_nome,
    atendimento.id,
    atendimento.valortotal,
    atendimento.desconto,
    data
From
    atendimento Inner Join
    atendente On atendimento.idatendente = atendente.id Inner Join
    motorista On atendimento.idcliente = motorista.id
    where 
    atendimento.id=:id 
    
				");
    $query->bindValue(":id", $_GET['id']);
    $resultado = $query->execute();

    $queryProduto = $conexao->query("SELECT id, nome, valor FROM produto ORDER BY nome");

    $queryServico = $conexao->query("SELECT id, nome, valor FROM servico ORDER BY nome");

    if ($query->rowCount()==0){
        exit("Objeto não encontrado");
    }

    $linha = $query->fetchObject();

} catch (PDOException $exception ) {
    echo $exception->getMessage();
}

    include("../configurações/bootstrap.php");
    include("../configurações/menu.php");

?>

<link href="../js/jquery.bootgrid.css" rel="stylesheet" />

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Orçamento - Itens</h2>
            <div class="card">
                <div class="card-header">
                    Dados do atendimento
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="usuario_id" class="col-sm-2 col-form-label">Cliente</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="usuario_id" value="<?php echo $linha->cliente_nome; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="data" class="col-sm-2 col-form-label">Data</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" id="data" value="<?php echo $linha->data; ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="data" class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" readonly class="form-control-plaintext" id="valor_total1" value="<?php echo $linha->valortotal; ?>">
                        </div>
                    </div>
                </div>
            </div>




            <ul class="nav nav-pills nav-justified" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="produto-tab" data-toggle="tab" href="#produto" role="tab" aria-controls="produto" aria-selected="true">Produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="servico-tab" data-toggle="tab" href="#servico" role="tab" aria-controls="servico" aria-selected="false">Serviços</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="produto" role="tabpanel" aria-labelledby="produto-tab">

                    <?php  include("modalProduto.php"); ?>

                </div>
                <div class="tab-pane fade" id="servico" role="tabpanel" aria-labelledby="servico-tab">
                    <div class="tab-pane fade show active" id="servico" role="tabpanel" aria-labelledby="servico-tab">

                    <?php  include("modalServico.php"); ?>
                    </div>

                </div>
            </div>



            <div class="float-right">
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#finalizar">
                    Finalizar
                </button>

                <!-- Modal de Finalizar -->
                <div class="modal fade" id="finalizar" tabindex="-1" role="dialog" aria-labelledby="finalizarLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="finalizarLabel">Finalizar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="finalizarOrcamento.php" method="post" class="formFinalizar">
                                    <div class="form-group">
                                        <label for="valor_total">Valor Total</label>
                                        <input type="number" readonly class="form-control" id="valor_total">
                                    </div>
                                    <div class="form-group">
                                        <label for="desconto">Desconto</label>
                                        <input type="number" min="0" step="any" class="form-control" id="desconto" name="desconto" required value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="valor_final">Valor Final</label>
                                        <input type="number" readonly class="form-control" id="valor_final" name="valor_final">
                                    </div>
                                    <div class="form-group">
                                        <label for="valor_final">Escolha de pagamento</label>
                                        <select name="pagamento" id="cars">
                                            <option>Debito</option>
                                            <option>Credito</option>
                                            <option>Dinheiro</option>
                                        </select>
                                    </div>


                                    <div class="form-group">
                                        <input type="hidden" name="idatendimento" value="<?php echo $_GET['id']; ?>">
                                        <button type="submit" class="btn btn-success" >Salvar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- fim do modal de Serviços -->

                <!--                <a href="exibirOrcamento.php?id=--><?php //echo $_GET['id']; ?><!--" class="btn btn-success">Finalizar</a>-->
            </div>

        </div>
    </div>
</div>

<script src="../js/jquery.bootgrid.js"></script>
<script src="../js/jquery.bootgrid.fa.js"></script>

<script>
    var gridProduto, gridServico;
    $(document).ready(function(){
        $("#desconto").on("change", function () {
            var final;
            final = $("#valor_total").val() - $(this).val();
            $("#valor_final").val(final);
        });

        gridProduto = $("#grid-produto").bootgrid({
            ajax: true,
            rowCount: -1,
            url: "bootgridProduto.php",
            post: function ()
            {
                return {
                    id: <?php echo $_GET['id']; ?>
                };
            },
            formatters: {
                "commands": function(column, row)
                {
                    return "<button type=\"button\" class=\"btn btn-danger command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fas fa-trash\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function()
        {
            gridProduto.find(".command-delete").on("click", function(e)
            {
                iziToastExcluir($(this).data("row-id"));
            });
        });

        gridServico = $("#grid-servico").bootgrid({
            ajax: true,
            rowCount: -1,
            url: "bootgridServico.php",
            post: function ()
            {
                return {
                    id: <?php echo $_GET['id']; ?>
                };
            },
            formatters: {
                "commands": function(column, row)
                {
                    return "<button type=\"button\" class=\"btn btn-danger command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fas fa-trash\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function()
        {
            gridServico.find(".command-delete").on("click", function(e)
            {
                iziToastExcluir2($(this).data("row-id"));
            });
        });

		$('.jsonForm').ajaxForm({
            dataType:  'json',
            success:   function(data){
                if (data.status==true){
                    iziToast.success({
                        message: data.mensagem
                    });
                    $('.jsonForm').trigger('reset');
                    gridProduto.bootgrid("reload");
                    gridServico.bootgrid("reload");
                    atualizaValorTotal();
                }else{
                    iziToast.error({
                        message: data.mensagem
                    });
                }
                $("#adicionarItem").modal('hide');
            },
            error: function (data) {
                iziToast.error({
                    message: 'Servidor retornou erro'
                });
                $("#adicionarItem").modal('hide');
            }
        });

    });

    function atualizaValorTotal() {
        $.getJSON(
            "orcamentoTotal.php",
            { id : <?php echo $_GET['id']; ?>},
            function(data){
                $("#valor_total1").val(data.valortotal);
                $("#valor_total").val(data.valortotal);
                $("#valor_final").val(data.valortotal);
                $("#desconto").attr("max", data.valortotal);
            },
        );
    }
    atualizaValorTotal();

    function excluir(id){
        $.post(
            "excluirProduto.php",
            { id: id },
            function( data ) {
                if (data.status==0){
                    iziToast.error({
                        message: data.mensagem
                    });
                }else{
                    iziToast.success({
                        message: data.mensagem
                    });
                    gridProduto.bootgrid("reload");
                    atualizaValorTotal();
                }
            },
            "json"
        );
    }

    function excluir2(id){
        $.post(
            "excluirServico.php",
            { id: id },
            function( data ) {
                if (data.status==0){
                    iziToast.error({
                        message: data.mensagem
                    });
                }else{
                    iziToast.success({
                        message: data.mensagem
                    });
                    gridServico.bootgrid("reload");
                    atualizaValorTotal();

                }
            },
            "json"
        );
    }

</script>
