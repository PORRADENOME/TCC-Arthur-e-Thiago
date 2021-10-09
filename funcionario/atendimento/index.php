<?php
//    require "../configurações/seguranca.php";
require "../configurações/segurança.php";

include("../configurações/bootstrap.php");
include("../configurações/menu.php");

?>
<link href="../js/jquery.bootgrid.css" rel="stylesheet" />

<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Atendimento - Listagem</h2>
            <table id="grid-data" class="table table-condensed table-hover table-striped">
                <thead>
                <tr>
                    <th data-column-id="id" data-order="desc" data-sortable="true">Código</th>
                    <th data-column-id="atendente_nome">Atendente</th>
                    <th data-column-id="cliente_nome">Cliente</th>
                    <th data-column-id="desconto" data-sortable="false">Desconto</th>
                    <th data-column-id="valortotal" data-sortable="false">Total</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false">Ações</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script src="../js/jquery.bootgrid.js"></script>
<script src="../js/jquery.bootgrid.fa.js"></script>

<script>
    var grid;
    $(document).ready(function(){
        grid = $("#grid-data").bootgrid({
            ajax: true,
            url: "bootgrid.php",
            formatters: {
                "commands": function(column, row)
                {
                    return "<button type=\"button\" class=\"btn btn-primary command-edit\" data-row-id=\"" + row.id   + "\"><span class=\"fas fa-edit\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-warning command-exibir\" data-row-id=\"" + row.id   + "\"><span class=\"fas fa-eye\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-danger command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fas fa-trash\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function()
        {
            grid.find(".command-edit").on("click", function(e)
            {
                document.location = 'formCadastrarItens.php?id=' + $(this).data("row-id");
            }).end().find(".command-exibir").on("click", function(e)
            {
                document.location = 'exibirOrcamento.php?id=' + $(this).data("row-id");
            }).end().find(".command-delete").on("click", function(e)
            {
                iziToastExcluir($(this).data("row-id"));
            });
        });
    });

    function excluir(id){
        $.post(
            "excluir.php",
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
                    grid.bootgrid("reload");
                }
            },
            "json"
        );
    }

</script>
