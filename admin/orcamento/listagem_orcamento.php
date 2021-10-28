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

<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Listagem - Orcamento</h1>
            <br>
            <table id="grid-data" class="table table-condensed table-hover table striped">
                <thead>
                <tr>
                    <th data-column-id="data_e_horario" data-order="desc" data-sortable="true">Cliente</th>
                    <th data-column-id="data_e_horario" data-order="desc" data-sortable="true">Data e Horário</th>
                    <th data-column-id="inf_adicionais" data-sortable="true">Informações</th>
                    <th data-column-id="nome_endereco" data-sortable="true">Endereço Partida</th>
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
            url: "bootgrid.php",
            formatters: {
                "commands": function (column, row) {
                    return"<button type=\"button\" class=\"btn btn-danger command-delete\" data-row-id=\"" + row.id_orcamento + "\"><span class=\"fas fa-trash\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function () {
            grid.find(".command-edit").on("click", function (e) {
                document.location = 'form_editar_orcamento.php?id=' + $(this).data("row-id");
            }).end().find(".command-delete").on("click", function (e) {
                iziToastExcluir($(this).data("row-id"));

            });

        });

    });

    function excluir(id) {
        $.post(
            "excluir_orcamento.php",
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

