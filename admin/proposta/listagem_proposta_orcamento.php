<?php


require "../configurações/segurança.php";
try {
    require "../configurações/conexao.php";

} catch (PDOException $exception) {
    echo $exception->getMessage();
}

include("../configurações/bootstrap.php");
include("../configurações/menu.php");
?>

<link href="../js/jquery.bootgrid.css" rel="stylesheet"/>

<title>Listagem de Propostas</title>

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Listagem de Propostas</h1>
            <br>
            <table id="grid-data" class="table table-condensed table-hover table striped">
                <thead>
                <tr>
                    <th data-column-id="nome_motorista" data-sortable="true">Motorista</th>
                    <th data-column-id="preco" data-order="desc" data-sortable="true">Preço</th>
                    <th data-column-id="informacoes_adicionais" data-sortable="true">Informações</th>
                    <th data-column-id="commands" data-formatter="commands" data-sortable="false"></th>

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
    $(document).ready(function () {
        grid = $("#grid-data").bootgrid({
            ajax: true,
            url: "bootgrid_propostas.php",
            formatters: {
                "commands": function (column, row) {
                    return "<button type=\"button\" class=\"btn btn-danger command-delete\" data-row-id=\"" + row.id_proposta + "\"><span class=\"fas fa-times\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function () {
            grid.find(".command-edit").on("click", function (e) {
                document.location = 'visualizar_proposta_orcamento.php?id=' + $(this).data("row-id");
            }).end().find(".command-delete").on("click", function (e) {
                iziToastDesativar($(this).data("row-id"));

            });

        });

    });

    function desativar(id) {
        $.post(
            "desativar_proposta.php",
            {id: id},
            function (data) {
                if (data.status == 0) {
                    iziToast.error({
                        message: data.mensagem
                    });
                } else {
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


