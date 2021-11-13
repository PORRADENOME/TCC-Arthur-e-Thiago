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

<title>Meus Endereços</title>

<div class="container_sm">
    <div class="row">
        <div class="col-12">
            <h1>Meus Endereços</h1>
            <br>
            <table id="grid-data" class="table table-condensed table-hover table striped">
                <thead>
                <tr>
                    <th data-column-id="nome_endereco" data-order="desc" data-sortable="true">Nome</th>
                    <th data-column-id="pais" data-sortable="true">País</th>
                    <th data-column-id="nome_estado" data-sortable="true">Estado</th>
                    <th data-column-id="nome_cidade" data-sortable="true">Cidade</th>
                    <th data-column-id="bairro" data-sortable="true">Bairro</th>
                    <th data-column-id="rua" data-sortable="true">Rua</th>
                    <th data-column-id="numero" data-sortable="true">Número</th>
                    <th data-column-id="complemento" data-sortable="true">Complemento</th>
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
                    return "<button type=\"button\" class=\"btn btn-primary command-edit\" data-row-id=\"" + row.id_endereco + "\"><span class=\"fas fa-edit\"></span></button> " +
                        "<button type=\"button\" class=\"btn btn-danger command-delete\" data-row-id=\"" + row.id_endereco + "\"><span class=\"fas fa-trash\"></span></button>";
                }
            }
        }).on("loaded.rs.jquery.bootgrid", function () {
            grid.find(".command-edit").on("click", function (e) {
                document.location = 'form_editar_endereco.php?id=' + $(this).data("row-id");
            }).end().find(".command-delete").on("click", function (e) {
                iziToastExcluir($(this).data("row-id"));

            });

        });

    });

    function excluir(id) {
        $.post(
            "excluir_endereco.php",
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

